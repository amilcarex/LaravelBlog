@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">equalizer</i>
            </div>
            <p class="card-category">Website Visits </p>
            <h3 class="card-title">{{$visits_statistics->total_visits}}
              <small>Visits</small>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-success">visibility</i>
              Total visits current year
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">task_alt</i>
            </div>
            <p class="card-category">Tasks this Year</p>
            <h3 class="card-title">{{$tasks_statistics->completed_annual}}
              <small>@if($tasks_statistics->completed_annual > 1) Tasks @else Task @endif</small>
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              @php($compare = $tasks_statistics->current_month - $tasks_statistics->last_month)
              <i class="material-icons @if($compare < 0) text-danger @else text-success @endif">@if($compare < 0) trending_down @else trending_up @endif</i> @if($compare < 0) @php( $compare=abs($compare)) {{$compare}} less than the previous month @else {{$compare}} more than the previous month @endif </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        @include('includes.statistics.visitsGraph')
      </div>
      <div class="row" id="container-tasksGraph">
        @include('includes.statistics.tasksGraph')
      </div>
      <div class="row">
        <div class="col-lg-10 mx-auto col-md-12">
          <div class="card">
            <div class="card-header card-header-tabs card-header-primary">
              <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                  <span class="nav-tabs-title">Tasks:</span>
                  <ul class="nav nav-tabs" data-tabs="tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#pending" data-toggle="tab">
                        <i class="material-icons">pending_actions</i> Pending Tasks
                        <div class="ripple-container"></div>
                      </a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link" href="#messages" data-toggle="tab">
                      <i class="material-icons">code</i> Website
                      <div class="ripple-container"></div>
                    </a>
                  </li> -->

                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="pending">
                  <table class="table">
                    <tbody id="pending-tasks">
                    @include('includes.tasks.pending')
                    </tbody>
                  </table>
                </div>
                <!-- <div class="tab-pane" id="messages">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="" checked>
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </td>
                      <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                      </td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" value="">
                            <span class="form-check-sign">
                              <span class="check"></span>
                            </span>
                          </label>
                        </div>
                      </td>
                      <td>Sign contract for "What are conference organizers afraid of?"</td>
                      <td class="td-actions text-right">
                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                          <i class="material-icons">edit</i>
                        </button>
                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                          <i class="material-icons">close</i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
    });
  </script>
  @endpush