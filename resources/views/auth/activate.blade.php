@extends('layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>{{__('Account activation')}}</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => ['activate' => 'Account activation']])
                @endcomponent

            </div>
            <div class="col-md-12">
                <strong>Thank you for registering an acount. At the very moment we need to verify by hand that your account has been created. When that happens we will contact you.</strong>
            </div>
        </div>
    </div>
    </div>
@endsection
