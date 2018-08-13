<div class="padding ">
  <div class=" overflow" style="color:rgb(23, 162, 184);">
      <h3 class="float-left "> {{ $user->name }}</h3>
      <div class="float-right ">
          <span class="d-block">{{ $user->address }}</span>
          <span class="d-block">{{ $user->phone }}</span>  
      </div>
  </div>
  <hr>
  <div>
    @foreach($cv as $cvItem)
      <div  style="font-weight: bold;">
        {{$cvItem->answear}}
      </div>
    @endforeach
  </div>
</div>

<style type="text/css" media="all"> 
  .padding{
    padding:2% 5%;
  }
  .overflow{
    overflow:hidden;
    height: 4%;
  }
  .d-block{
    display:block;;
  }
  .float-right{
    float: right;
  }
  .float-left{
    float:left;
  }
<style>
