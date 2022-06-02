
        <div class="form-group">
        <label for="blog_title">Title</label>
        <input type="text" class="form-control"  id="name" name='name'
            value="{{old("name",$youtubeVideo->name)}}" autocomplete="off">
    </div>

<div class="form-group">
    <label for="blog_subtitle">URL</label>
    <input type="text" class="form-control" required id="url" aria-describedby="url_help" name='url'
           value='{{old("url",$youtubeVideo->url)}}' autocomplete="off">
    @if($youtubeVideo->url)
    <a href="{{ $youtubeVideo->url }}" target="_blank" class="card-link btn btn-primary mt-2">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    View Video</a>
    @endif
    <small id="url_help" class="form-text text-muted">Youtube Video URL e.g. https://www.youtube.com/watch?v=45HzGADTm4c</small>
</div>

<div class="form-group">
    <label for="blog_subtitle">Display Order</label>
    <input type="number" class="form-control" required id="display_order"  name='display_order'
           value='{{old("display_order",$youtubeVideo->display_order)}}' min="1" steps="1">
</div>

<div class="form-group " >
                    
                <label for="thumbnail">Image</label>
                
                <input class="form-control" type="file" name="thumbnail" id="thumbnail" >

<div style='max-width:55px;' class='m-2'>
                        <a style='cursor: zoom-in;' target='_blank' href='{{$youtubeVideo->image_url()}}'>
                            <img style="max-width:150px" src="{{$youtubeVideo->image_url()}}" />
                        </a>
                    </div>
            </div>


    
<div class="form-group">
    <label for="status">Enabled</label>

    <select required class="form-control" name="status" id="status">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

</div>

<div class="form-group">
    <label for="is_featured">Is Featured</label>

    <select required class="form-control" name="is_featured" id="is_featured">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

</div>

<div class="form-group">
    <label for="display_order_home">Home Display Order</label>

    <select required class="form-control" name="display_order_home" id="display_order_home">
        <option value="1">video #1</option>
        <option value="2">video #2</option>
    </select>

</div>

<script>
    document.getElementById("status").value = '{{ old("status",$youtubeVideo->status) === 0?"0":"1" }}';
    document.getElementById("is_featured").value = '{{ old("status",$youtubeVideo->is_featured) === 0?"0":"1" }}';
    document.getElementById("display_order_home").value = '{{ old("status",$youtubeVideo->display_order_home) === 1?"1":"2" }}';
</script>