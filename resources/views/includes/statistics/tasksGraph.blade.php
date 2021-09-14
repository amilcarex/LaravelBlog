
    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header card-header-success">
                <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Completed Tasks</h4>
                <p class="card-category">Last 4 Months</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-success">access_time</i> Updated {{ $tasks_statistics->updated }} ago
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="card card-stats pr-4" style="height:292px!important">
            <div class="card-header card-header-success card-header-icon pt-4 mb-3">
                <div class="card-icon" style="margin-top:-45px!important;">
                    <i class="material-icons">analytics</i>
                </div>
                <h3 class="card-title mb-4">Tasks Summary</h3>
                <p class="card-category subtittle-card-statistics">Total: {{$tasks_statistics->total}}</p>
                <p class="card-category subtittle-card-statistics">Complete Tasks: {{$tasks_statistics->completed}}</p>
                <p class="card-category subtittle-card-statistics">Incomplete Tasks: {{$tasks_statistics->incompleted}}</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-success">trending_up</i> Summary of the last 4 months
                </div>
            </div>
        </div>
    </div>
