<?php

namespace App\Http\Controllers\Sigarang\Goods;

use App\Models\Sigarang\Goods\Category;
use App\Base\BaseController;
use App\Libraries\Mad\Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends BaseController
{
    protected static $partName = "backyard";
    protected static $moduleName = "sigarang";
    protected static $submoduleName = "goods";
    protected static $modelName = "category";
    
    public function __construct()
    {
        $this->middleware('permission:' . self::getRoutePrefix('index'), ['only' => ['index','indexData']]);
        $this->middleware('permission:' . self::getRoutePrefix('show'), ['only' => ['show']]);
        $this->middleware('permission:' . self::getRoutePrefix('create'), ['only' => ['create']]);
        $this->middleware('permission:' . self::getRoutePrefix('store'), ['only' => ['store']]);
        $this->middleware('permission:' . self::getRoutePrefix('edit'), ['only' => ['edit']]);
        $this->middleware('permission:' . self::getRoutePrefix('update'), ['only' => ['update']]);
        $this->middleware('permission:' . self::getRoutePrefix('destroy'), ['only' => ['destroy']]);
    }
    
    public function index()
    {
        return self::makeView('index');
    }
    
    public function indexData(Request $request)
    {
        $search = $request->get('search')['value'];
        
        $categoryTableName = Category::getTableName();
        
        $q = Category::query()
            ->select([
                "{$categoryTableName}.name",
                "{$categoryTableName}.id",
            ]);
        
            Helper::fluentMultiSearch($q, $search, [
                "{$categoryTableName}.name",
            ]);
            
        $res = DataTables::of($q)
            ->editColumn('name', function(Category $v) {
                return '<a href="' . route(self::getRoutePrefix('show'),$v->id) .'">' . $v->name . '</a>';
            })
            ->editColumn('_menu', function(Category $model) {
                return self::makeView('index-menu', compact('model'))->render();
            })
            ->rawColumns(['name', '_menu'])
            ->make(true);
        
        return $res;
    }
    
    public function create()
    {
        return self::makeView('create');
    }
    
    public function store(Request $request)
    {
        $categoryTableName = Category::getTableName();
        $this->validate($request, [
            'name' => "required|unique:{$categoryTableName},name",
        ]);
        
        $res = true;
        $input = $request->all();
        $category = new Category();
        $category->fill($input);
        $res &= $category->save();
        
        if ($res) {
            return redirect()->route(self::getRoutePrefix('index'))
                ->with("success", "Category create successfully");
        } else {
            return redirect()->route(self::getRoutePrefix('index'))
                ->with("error", sprintf("<div>%s</div>", implode("</div><div>", $category->errors)));
        }
    }
    
    public function edit($id)
    {
        $category = Category::find($id);
        $options = compact('category');
        return self::makeView('edit', $options);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ["required"],
        ]);
        
        $res = true;
        $input = $request->all();
        $category = Category::find($id);
        $category->fill($input);
        $res &= $category->save();
        
        if ($res) {
            return redirect()->route(self::getRoutePrefix('index'))
                ->with("success", "Category create successfully");
        } else {
            return redirect()->route(self::getRoutePrefix('index'))
                ->with("error", sprintf("<div>%s</div>", implode("</div><div>", $category->errors)));
        }
    }
    
    public function show($id)
    {
        $category = Category::find($id);
        
        return self::makeView('show', compact('category'));
    }
    
    public function destroy($id)
    {
        /* @var $model Category */
        $model = Category::find($id);
        if(count($model->goods)!=0){
            return 'Data has been used';
        }
        return $model->delete() ? '1' : 'Data cannot be deleted';
    }
}

