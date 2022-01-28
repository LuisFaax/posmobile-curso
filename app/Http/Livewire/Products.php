<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Image;
use App\Models\Measure;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name = '', $code = '', $description = '', $cost = "0.00", $price1 = "0.00", $price2 = "0.00", $stock = 0, $minstock = 0, $selected_id = 0, $categoryid = "Elegir",
        $measureid = "Elegir", $componentName = 'Productos', $search = '', $gallery = [];
    private $pagination = 5;

    protected $paginationTheme = 'tailwind';


    public function render()
    {
        if (strlen($this->search) > 0) {
            $info = Product::join('categories as c', 'c.id', 'products.category_id')
                ->join('measures as m', 'm.id', 'products.measure_id')
                ->select('products.*', 'c.name as category', 'm.name as measure')
                ->where('products.code', 'like', "%{$this->search}%")
                ->orWhere('products.name', 'like', "%{$this->search}%")
                ->orWhere('products.description', 'like', "%{$this->search}%")
                ->orWhere('c.name', 'like', "%{$this->search}%")
                ->orWhere('m.name', 'like', "%{$this->search}%")
                ->paginate($this->pagination);
        } else {
            $info = Product::join('categories as c', 'c.id', 'products.category_id')
                ->join('measures as m', 'm.id', 'products.measure_id')
                ->select('products.*', 'c.name as category', 'm.name as measure')
                ->paginate($this->pagination);
        }


        return view('livewire.products.component', [
            'data' => $info,
            'categories' => Category::orderBy('name', 'asc')->get(),
            'measures' => Measure::orderBy('name', 'asc')->get()
        ])
            ->extends('layouts.theme.app');
    }

    public $listeners = ['resetUI'];


    public function noty($msg, $eventName = 'noty', $reset = true)
    {
        $this->dispatchBrowserEvent($eventName, ['msg' => $msg, 'type' => 'success']);
        if ($reset) $this->resetUI();
    }

    public function AddNew()
    {
        $this->resetUI();
        $this->noty(null, 'open-modal');
    }

    public function resetUI()
    {
        $this->resetValidation();
        $this->resetPage();
        $this->reset([
            'name', 'code', 'description', 'cost',
            'price1', 'price2', 'stock', 'minstock',
            'selected_id', 'measureid', 'categoryid',
            'search', 'gallery'
        ]);
    }

    public function Edit(Product $product)
    {
        $this->code = $product->code;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->cost = $product->cost;
        $this->price1 = $product->price1;
        $this->price2 = $product->price2;
        $this->stock = $product->stock;
        $this->minstock = $product->minstock;
        $this->categoryid = $product->category_id;
        $this->measureid = $product->measure_id;
        $this->selected_id = $product->id;

        $this->noty('', 'open-modal', false);
    }

    public function Store()
    {
        sleep(1);

        $this->validate(Product::rules($this->selected_id), Product::$messages);

        $product = Product::updateOrCreate(
            ['id' => $this->selected_id],
            [
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description,
                'cost' => $this->cost,
                'price1' => $this->price1,
                'price2' => $this->price2,
                'stock' => $this->stock,
                'minstock' => $this->minstock,
                'category_id' => $this->categoryid,
                'measure_id' => $this->measureid

            ]
        );

        if (!empty($this->gallery)) {
            // eliminar imagenes del disco
            if ($this->selected_id > 0) {
                $product->images()->each(function ($img) {
                    if ($img->file != null && file_exists('storage/products/' . $img->file)) {
                        unlink('storage/products/' . $img->file);
                    }
                });

                // eliminar las relaciones
                $product->images()->delete();
            }

            // guardar imagenes nuevas
            foreach ($this->gallery as $photo) {
                $customFileName = uniqid() . '_.' . $photo->extension();
                $photo->storeAs('public/products', $customFileName);

                // creamos relacion
                $img = Image::create([
                    'model_id' => $product->id,
                    'model_type' => 'App\Models\Product',
                    'file' => $customFileName
                ]);

                // guardar relacion
                $product->images()->save($img);
            }
        }
        $this->noty($this->selected_id > 0 ? 'Producto Actualizado' : 'Producto Registrado');
    }


    public function Destroy(Product $product)
    {
        try {

            // eliminar imagenes del storage
            $product->images()->each(function ($img) {
                if ($img->file != null && file_exists('storage/products/' . $img->file)) {
                    unlink('storage/products/' . $img->file);
                }
            });

            // delete images fropm db
            $product->images()->delete();

            $this->resetUI();
            $this->noty('Producto eliminado');
        } catch (Exception $e) {
            $this->noty('Error al intentar eliminar el producto');
        }
    }
}
