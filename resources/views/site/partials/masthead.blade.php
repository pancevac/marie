<div class="masthead">
  <simple-carousel dots loop>

    @for($i = 0; $i < 4; $i++)
    <div class="slider-item masthead-item-wrap">
      <div class="masthead-item">
        <div class="masthead-item_content">
          <a class="details-item details-item--primary" href="#">category</a>
          <div class="masthead-item_title"><a href="#">Article title #{{$i + 1}} long text follows...</a></div>
        </div>
        <div class="masthead-item_image">
          <a href="#" title="alt tag">
            <div class="image image--16-9 js-lazy-image"
              data-src=""
              data-alt="alt tag"
            ></div>
          </a>
        </div>
      </div>
    </div>
    @endfor

  </simple-carousel>

</div>