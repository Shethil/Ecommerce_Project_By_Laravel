@extends('frontend.layouts.master')

@section('frontend_title')
    Home Page
@endsection

@section('frontend_content')

    @include('frontend.pages.widgets.slider')

    @include('frontend.pages.widgets.featured')

    @include('frontend.pages.widgets.count-down')

    @include('frontend.pages.widgets.best-seller-product')

    @include('frontend.pages.widgets.latest-product')

    @include('frontend.pages.widgets.testmonial')

@endsection
