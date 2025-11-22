@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
    @if(session ('message'))
    <div class="category__alert--success">
        {{session('message')}}
    </div>
    @endif
    @if($errors->any())
    <div class="category__alert--danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
</div>

<div class="category-create__item">
    <form class="create-form" action="/categories" method="post">
        @csrf
        <input  class="create-form__input" type="text" name="name" value="{{old('name')}}">
        <button class="create-form__submit" type="submit">作成</button>
    </form>
</div>

<div class="category-table">
    <table class="category-table__inner">
        <tr class="category-table__header">
            <th class="category-table__ttl">category</th>
        </tr>
        @foreach($categories as $category)
        <tr class="category-table__row">
            <td class="category-table__item">
                <form class="update-form" method="post" action="/categories/update">
                    @method('PATCH')
                    @csrf
                    <div class="update-form__item">
                        <input type="hidden" name="id" value="{{$category['id']}}">
                        <input  class="update-form__input" type="text" name="name" value="{{$category['name']}}">
                        <button class="update-form__submit" type="submit">更新</button>
                    </div>
                </form>
                <form class="delete-form" method="post" action="/categories/delete">
                    @method('delete')
                    @csrf
                        <div class="delete-form__item">
                            <input type="hidden" name="id" value="{{$category['id']}}">
                            <button class="delete-form__submit" type="submit">削除</button>
                        </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection