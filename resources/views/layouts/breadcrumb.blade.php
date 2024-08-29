<section class="content-header"> 
  <div class="container-fluid"> 
      <div class="row mb-2"> 
          <div class="col-sm-6"> 
              <h1>{{ $breadcrumb->title }}</h1> 
          </div> 
          <div class="col-sm-6"> 
              <ol class="breadcrumb float-sm-right"> 
                  @foreach($breadcrumb->list as $l) 
                      <li class="breadcrumb-item"><a href="#">{{ $l }}</a></li> 
                  @endforeach 
              </ol> 
          </div> 
      </div> 
  </div> 
</section>