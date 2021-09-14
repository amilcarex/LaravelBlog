  @foreach($pending_tasks as $task)
  <tr>
      <td>{{$task->name}}</td>
      <td class="td-actions text-right">
          <button type="button" id="complete-task" value="{{$task->id}}"  class="btn btn-primary btn-link btn-sm" style="margin-left: auto;margin-right: 20px;">
              <i class="material-icons">done_outline</i>
          </button>
      </td>
  </tr>
  @endforeach