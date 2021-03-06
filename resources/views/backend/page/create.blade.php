@extends('backend.layouts.master')

@section('seo')
    @component("components.seo", [
    "title" => "Create a page",
    "url" => url('admin/pages/create'),
    "description" => "Create a new page for " . env('APP_NAME')
    ] )
    @endcomponent
@endsection

@section('content')

    <section id="featured_line_section">
        <div class="featured_line greenblue"></div>
    </section>

    <div class="container backend-main">
        <div class="row">
            <div class="col-md-12">

                {{-- Title --}}
                <h1>Create an page</h1>

                {{--Breadcrumbs--}}
                @component('backend.components.breadcrumbs', ['breadcrumbs' => ['admin/pages' => 'Page', 'admin/pages/create' => 'Create a page']])
                @endcomponent

            <div class="col-md-12 tablink-box">
                <a class="tablink tab-active" role="tab" id="defaultOpen" onclick="openPage('tab-content', this)">Content</a>
                <a class="tablink" role="tab" onclick="openPage('tab-sidebar', this)" id="defaultOpen">Sidebar</a>
            </div>

            <form method="POST" action="{{url('/admin/pages')}}">

                <div id="tab-content" class="tabcontent" role="tabpanel">

                    {{--Load the form--}}
                    @component('backend.page.form', compact('page'))
                    @endcomponent

                </div>

                <div id="tab-sidebar" class="tabcontent" role="tabpanel">

                    {{--Load the form--}}
                    @component('backend.page.form-sidebar', compact('page'))
                    @endcomponent

                </div>
            </form>


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