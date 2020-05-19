  <!-- Modal -->
  <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-center" role="document">
      <div class="modal-content bg-snow  text-{{$type}}">
        <div class="modal-header text-center">
          <h5 class="ml-auto" id="exampleModalLabel">{{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{$content}}
        </div>
      </div>
    </div>
  </div>
