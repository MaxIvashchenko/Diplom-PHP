<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ThemeController extends Controller
{
    /** Список тем    */
    public function getIndex()
    {
        $result = DB::select(
            DB::raw(
                "SELECT COUNT(*) as QNum, 
                SUM(IF(questions.category_id = c.id AND questions.published = 1, 1, 0)) 
                as QPubNum FROM questions WHERE questions.category_id = c.id"));
        return view('/admin/theme/index', compact('result'));
    }
    /** Страница добавления новых тем     */
    public function getAdd()
    {
        return view('admin/theme/add');
    }
    /** Сохранение новой темы */
    public function postAdd(Request $request)
    {
        $name = $request->input('inputName');
        $category = new Category();
        $category->name = $name;
        $category->save();
        Log::info(Auth::user()->name.' добавил тему '.$category->name);
        return redirect('/admin/theme/index');
    }
    /** Страница удаления темы
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDelete($id = 0)
    {
        $category = Category::find((int)$id)->toArray();
        return view('admin/theme/delete', compact('category'));
    }
    /** Удаление темы
     * @param int $id     */
    public function postDelete($id = 0)
    {
        $category = Category::find((int)$id);
        $questions = Question::where('category_id', '=', $id)->with('answer');
        $category->delete();
        $questions->delete();
        Log::info(Auth::user()->name.' удалил тему '.$category->name);
        return redirect('/admin/theme/index');
    }
    /** Страница смены темы      */
    public function getChange($id = 0)
    {
        $categories = $questions = $result = [];
        $categories = Category::all()->toArray();
        $question = Question::where('id', '=', (int)$id)
            ->with('answer', 'category')
            ->get()->toArray()[0];
        return view('admin/theme/change', compact('categories', 'question'));
    }
    /** Сохранение смены темы      */
    public function postChange($id = 0, Request $request)
    {
        $category_id = $request->input('inputCategory');
        $question = Question::find((int)$id);
        $question->category_id = $category_id;
        $question->save();
        Log::info(Auth::user()->name.' у вопроса ( '.$id.' ) сменил тему на '.$question->category->name);
        return redirect('/admin/theme/index');
    }
}
