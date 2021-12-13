<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Raks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BooksController extends Controller
{
    public function index()
	{
		$products = self::getProducts();  

        $data['data'] = $products;

        return view('buku.index', $data);
    }
    
	public function filter($tags)
	{
		$products = self::getProductByTags($tags);  

        $data['data'] = $products;

        return view('buku.index', $data);
    }

    public function form()
    {
        $data['data'] = Raks::all();

        return view('buku.form', $data);
    }

    public function post(Request $request)
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameSimpan = $filename.'_'.time().'.'.$extension;
        $path = $request->file('image')->storeAs('public/image', $filenameSimpan);

		$lokasi = Raks::where('id', $request->lokasi)->first()->lokasi;

		$productId = self::getProductId();  
		$tagsId = self::getProductToTagsId($request->jenis);  

		self::newProduct($productId, [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'image' => 'storage/image/'. $filenameSimpan,
            'lokasi' => $lokasi,
			'jenis' => $request->jenis,
			'product_id' => $productId
        ]);

		self::newProductToTags($productId, [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'image' => 'storage/image/'. $filenameSimpan,
            'lokasi' => $lokasi,
			'jenis' => $request->jenis,
			'product_id' => $productId
        ], $request->jenis);

        return redirect('buku')->with('success', 'Buku berhasil ditambah');
    }

    public function edit($id)
    {
        $data['data'] = Redis::hGetAll("product:$id");  
        $data['rak'] = Raks::all();
        return view('buku.edit', $data);
    }

    public function update(Request $request)
    {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filenameSimpan = $filename.'_'.time().'.'.$extension;
        $path = $request->file('image')->storeAs('public/image', $filenameSimpan);

		$before = Redis::hGetAll("product:$request->id");  
		if (Redis::exists('product_' . $before['jenis'] . ':' . $request->id)){
			Redis::del('product_' . $before['jenis'] . ':' . $request->id);
		}

		self::newProduct($request->id, [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'image' => 'storage/image/'. $filenameSimpan,
            'lokasi' => $request->lokasi,
			'jenis' => $request->jenis,
			'product_id' => $request->id
        ]);

		self::newProductToTags($request->id, [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'image' => 'storage/image/'. $filenameSimpan,
            'lokasi' => $request->lokasi,
			'jenis' => $request->jenis,
			'product_id' => $request->id
        ], $request->jenis);

        return redirect('buku')->with('success', 'Buku berhasil diubah');
    }

    public function delete(Request $request)
    {
		Redis::del('product:' . $request->id);
		Redis::del('product_' . $request->jenis . ':' . $request->id);

        return redirect('buku')->with('success', 'Buku berhasil dihapus');
    }

	static function getProductId()  
	{  
		if (!Redis::exists('product_count')){
			Redis::set('product_count',0);  
		}
		 
		return Redis::incr('product_count');  
   }  
   
   /*
   * Create a hash map to hold a project object
   * e.g HMSET product:1 product "men jean" id 1 image "img-url.jpg" 
   * Then add the product ID to a list hold all products ID's
   */
   static function newProduct($productId, $data) : void  
   {  
		self::addToProducts($productId);  
	
		Redis::hMset("product:$productId", $data);  
   }  
   
   /*
   * A Ordered Set holding all products ID with the
   * PHP time() when the product was added as the score
   * This ensures products are listed in DESC when fetched
   */
   static function addToProducts($productId) : void  
   {  
		Redis::zAdd('products', time(), $productId);  
   } 

  static function getProductToTagsId($tags)  
  {  
	  if (!Redis::exists('product_' . $tags . '_count')){
		  Redis::set('product_' . $tags . '_count',0);  
	  }
	   
	  return Redis::incr('product_' . $tags . '_count');  
 }  
 
 /*
 * Create a hash map to hold a project object
 * e.g HMSET product:1 product "men jean" id 1 image "img-url.jpg" 
 * Then add the product ID to a list hold all products ID's
 */
 static function newProductToTags($productId, $data, $tags) : void  
 {  
	  self::addProductToTags($productId, $tags);  
  
	  Redis::hMset("product_$tags:$productId", $data);  
 }  
 
 /*
 * A Ordered Set holding all products ID with the
 * PHP time() when the product was added as the score
 * This ensures products are listed in DESC when fetched
 */
 static function addProductToTags($productId, $tag) : void  
 {  
	  Redis::zAdd('prodcut_' . $tag, time(), $productId);  
 } 
  /*  
  * In a real live example, we will be returning 
  * paginated data by calling the lRange command 
  * lRange start end 
  */  
  static function getProducts($start = 0, $end = -1) : array  
  {  
		$productIds = Redis::zRange('products', $start, $end);  
		$products = [];  
	
		foreach ($productIds as $productId => $score) 
		{  
			$products[$productId]= Redis::hGetAll("product:$score");  
		}
		
		return $products;  
   }

   static function getProductByTags($tag, $start = 0, $end = -1) : array  
	{  
		$productIds = Redis::zRange('products', $start, $end);  
		$products = [];  
		foreach ($productIds as $productId => $score) {
			if (Redis::exists('product_' . $tag . ':' . $score)){
				$products[] = Redis::hGetAll('product_' . $tag . ':' . $score); 
			}
		}
		
		return $products;  
	}
}
