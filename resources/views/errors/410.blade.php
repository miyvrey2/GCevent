@extends('layouts.master')

@section('content')

    <section id="featured_image_section">
        <div class="featured_image greenblue"  style="background-image:url('https://www.gamescomevent.com/img/gamescom_17_010_010.jpg')"></div>
    </section>

    <div class="container show">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>410 - Page gone</h1>

                {{--Breadcrumbs--}}
                @component('components.breadcrumbs', ['breadcrumbs' => [ url()->current() => collect(request()->segments())->last()]])
                @endcomponent

            </div>
            <div class="col-md-12">
                <p>
                    <strong>
                        Whoops! This is not what we wanted to display to you. We probably did something change on our behalf, but we did not foresee this error.
                    </strong>
                </p>
                <br />
                <p>
                    The page which you tried to find is not here anymore. We no longer offer this page. What you can do is try to look for a similiar page.
                    <br >
                    <br >

                    <a href="#" class="button button-primary">Go back</a> <a href="" class="button button-primary">Go to the homepage</a>
                </p>
            </div>

        </div>
    </div>
    </div>

@endsection