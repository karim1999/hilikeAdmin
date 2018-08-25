<?php

namespace App\Admin\Controllers;

use App\Membership;
use App\Http\Controllers\Controller;
use App\Permission;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class MembershipController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Index');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Membership::findOrFail($id), function (Show $show) {

                $show->id();
                $show->name_ar('Name Ar');
                $show->name_en('Name En');
                $show->description_ar('Description Ar');
                $show->description_en('Description En');

                $show->created_at();
                $show->updated_at();
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('Edit');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('Create');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Membership::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name_ar('Name Ar');
            $grid->name_en('Name En');
            $grid->description_ar('Description Ar')->display(function($text) {
                return str_limit($text, 60, '...');
            });
            $grid->description_en('Description En')->display(function($text) {
                return str_limit($text, 60, '...');
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Membership::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name_ar', 'Name Ar')->rules('required');
            $form->text('name_en', 'Name En')->rules('required');
            $form->textarea('description_ar', 'Description Ar')->rules('required');
            $form->textarea('description_en', 'Description En')->rules('required');

            $form->hasMany('services', function (Form\NestedForm $form) {
                $form->text('name_ar', 'Name Ar')->rules('required');
                $form->text('name_en', 'Name En')->rules('required');
                $form->textarea('description_ar', 'Description Ar')->rules('required');
                $form->textarea('description_en', 'Description En')->rules('required');
                $form->number('price', 'Price')->rules('required');
                $form->number('duration', 'Number of Days')->rules('required');
            });

            $form->hasMany('features', function (Form\NestedForm $form) {
                $form->text('text_ar', 'Feature Ar')->rules('required');
                $form->text('text_en', 'Feature En')->rules('required');
            });

            $form->multipleSelect('permissions')->options(Permission::all()->pluck('name', 'id'));

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
