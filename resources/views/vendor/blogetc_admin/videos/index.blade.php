@extends("blogetc_admin::layouts.admin_layout")
@section("content")


    <h5>Manage Videos</h5>

    @forelse($videos as $video)
        <div class="card m-4" style="">
            <div class="card-body">
                <h5 class='card-title'><a href="{{ route('videos.edit',$video->id) }}">{{$video->name}}</a></h5>
                <dl class="">
                    <dt class="">Thumbnail</dt>
                    <dd class=""><img style="max-width:150px" src="{{$video->image_url()}}" /></dd>

                    <dt class="">Display Order</dt>
                    <dd class="">{{$video->display_order}}</dd>
                    
                    <dt class="">Is Enabled?</dt>
                    <dd class="">

                        {!!($video->status ? "Yes" : 'No')!!}

                    </dd>
                    <dt class="">Is Featured?</dt>
                    <dd class="">

                        {!!($video->is_featured ? "Yes" : 'No')!!}

                    </dd>
                    @if($video->is_featured)
                    <dt class="">Featured Dispaly Order</dt>
                    <dd class="">

                        {!!($video->display_order_home == 1 ? "video #1" : 'video #2')!!}

                    </dd>
                    @endif
                </dl>


                
                <a href="{{ $video->url }}" target="_blank" class="card-link btn btn-primary">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    View Video</a>
                <a href="{{ route('videos.edit',$video->id) }}" class="card-link btn btn-primary">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    Edit Video</a>
                <form onsubmit="return confirm('Are you sure you want to delete this?\n You cannot undo this action!');"
                      method='post' action='{{route("videos.destroy", $video->id)}}' class='float-right'>
                    @csrf
                    <input name="_method" type="hidden" value="DELETE"/>
                    <button type='submit' class='btn btn-danger btn-sm'>
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class='alert alert-warning'>No videos to show you. Why don't you add one?</div>
    @endforelse



    <div class='text-center'>
        {{$videos->appends( [] )->links()}}
    </div>


@endsection