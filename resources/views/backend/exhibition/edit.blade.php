@extends('backend.layouts.master')

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Edit "{{$exhibition->title}}"</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/exhibitions' => 'exhibitions', 'admin/exhibitions/' . $exhibition->slug . '/edit' => 'Edit "' . $exhibition->title . '"']])
                @endcomponent
            </div>

            <div class="col-md-12 tablink-box">
                <a class="tablink tab-active" role="tab" id="defaultOpen" onclick="openPage('tab-exhibition', this)">Exhibition</a>
                <a class="tablink" role="tab" onclick="openPage('tab-games', this)" id="defaultOpen">Games</a>
            </div>

            <div id="tab-exhibition" class="tabcontent" role="tabpanel">

                <form method="POST" action="{{url('/admin/exhibitions/' . $exhibition->slug)}}">

                    {{--Set the post method to patch--}}
                    {{ method_field('PATCH') }}

                    {{--Load the form--}}
                    @component('backend.exhibition.form', compact('exhibitions', 'exhibition', 'games'))
                    @endcomponent

                </form>

            </div>
            <div id="tab-games" class="tabcontent">
                @component('backend.exhibition.form-game', compact('exhibitions', 'exhibition', 'games', 'developers', 'publishers'))@endcomponent
            </div>

            <script>
                function openPage(pageName, elmnt, color) {

                    // Hide all elements with class="tabcontent" by default */
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }

                    // Remove the background color of all tablinks/buttons
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].style.backgroundColor = "";
                        tablinks[i].classList.remove("tab-active");
                    }

                    // Show the specific tab content
                    document.getElementById(pageName).style.display = "block";

                    // Add the specific color to the button used to open the tab content
                    elmnt.classList.add("tab-active");
                }

                document.getElementById("defaultOpen").click();
            </script>

        </div>
    </div>
@endsection