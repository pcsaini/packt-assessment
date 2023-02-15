<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Pcsaini\ResponseBuilder\ResponseBuilder;

class BookController extends Controller
{
    public function index(Request $request)
    {
        try {
            $books = Book::query()
                ->when($request->has('sortBy') && $request->has('sortType'), function ($query) use($request){
                    $query->orderBy($request->get('sortBy'), $request->get('sortType', 'asc'));
                })
                ->when($request->has('search'), function ($query) use($request){
                    $search = $request->get('search');
                    $query->where('title', 'like', "%$search%")
                        ->orwhere('author', 'like', "%$search%")
                        ->orwhere('isbn', 'like', "%$search%")
                        ->orwhere('publisher', 'like', "%$search%")
                        ->orwhere('genre', 'like', "%$search%");
                });

            $books = $books->paginate($request->get('limit', 10));

            return ResponseBuilder::asSuccess()->withPagination($books)->build();
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->serverError);
        }
    }

    public function delete(Request $request, $id) {
        try {
            $book = Book::query()->find($id);

            if(!$book) {
                return ResponseBuilder::error(__('Sorry! we are not able to find this book'), $this->badRequest);
            }

            $book->delete();

            return ResponseBuilder::success(null,'The book deleted successfully');
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->serverError);
        }
    }

    public function view(Request $request, $id) {
        try {
            $book = Book::query()->find($id);

            if(!$book) {
                return ResponseBuilder::error(__('Sorry! we are not able to find this book'), $this->badRequest);
            }

            return ResponseBuilder::success($book);
        } catch (\Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->serverError);
        }
    }
}
