@include('admin.pages.layouts.header')
@include('admin.pages.layouts.sidebar')
@include('admin.pages.layouts.topbar')


<header class="header bg-ui-general" style="margin-bottom: 0px;">
    <div class="header-info" style="margin: 15px 0;">
        <h1 class="header-title">
            <strong>Cms Pages</strong>
        </h1>
    </div>
</header><!--/.header -->

<div class="main-content">
    <div class="row">
        <div class="col-sm-12">
            @if (session('status'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
            @endif
        </div>
        <div class="col-sm-12">
            <form method="post" action="{{url('dashboard/settings/pages/')}}/{{$page->id}}">
                <div class="card">
                    <h4 class="card-title">Edit {{$page->title}} page

                    </h4>

                    <div class="card-body">
                            <input type="hidden" name="_method" value="put">
                            @csrf
                            <label for="">Page Title</label>
                            <input type="text" name="title" value="{{$page->title}}" id="title" class="form-control">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" id="description" type="text">@php echo $page->description @endphp</textarea>
                        </form>
                    </div>
                    <footer class="card-footer text-right">
                        <a class="btn btn-orange text-white" href="{{url('dashboard/settings/pages')}}">Cancel</a>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </footer>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.pages.layouts.footer')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'description' );
</script>
