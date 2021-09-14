
let url = "http://localhost/blog-feragon-full/public";
// let url = document.domain;
$(document).ready(function () {
    //Alerts or Notifications
    let created = document.querySelector('#record_created');
    if(created != '' && created != null && created != undefined){
        Swal.fire(
            'Good job!',
            'Succesfully Created',
            'success'
        )
    }
    let password_error = document.querySelector('#current_password_error');
    if (password_error != '' && password_error != null && password_error != undefined){
        Swal.fire(
            'Error',
            'Current password is not Correct',
            'warning'
        )
    }
    let main_account = document.querySelector('#main_account');
    if (main_account != '' && main_account != null && main_account != undefined){
        Swal.fire(
            'Error',
            'The main account must be an administrator and cannot be deleted',
            'warning'
        )
    }
    let only_admin = document.querySelector('#only_admin');
    if (only_admin != '' && only_admin != null && only_admin != undefined){
        Swal.fire(
            'Error',
            'The role can only be modified by an administrator',
            'warning'
        )
    }
    let edited = document.querySelector('#record_edited');
    if (edited != '' && edited != null && edited != undefined){
        Swal.fire(
            'Good job!',
            'Succesfully Edited',
            'success'
        )
    }
    let deleted = document.querySelector('#record_deleted');
    if (deleted != '' && deleted != null && deleted != undefined){
        Swal.fire(
            'Good job!',
            'Succesfully Deleted',
            'success'
        )
    }
    let only_owner = document.querySelector('#only_owner');
    if (only_owner != '' && only_owner != null && only_owner != undefined){
        Swal.fire(
            'Error',
            'Only the account owner can access their experiences',
            'warning'
        )
        
    }
    let error = document.querySelector('#error');
    if (error != '' && error != null && error != undefined){
        Swal.fire(
            'Error',
            'Something has gone wrong',
            'warning'
        )
    }
    
    //Tinymce Init 

    
    tinymce.init({
        selector: '#editor',
        referrer_policy: "strict-origin-when-cross-origin",
        plugins: [
            "advlist autolink lists link image charmap print anchor",
            "searchreplace visualblocks code",
            "insertdatetime media table paste imagetools code help wordcount",
            "autosave",
        ],
        toolbar:
            "undo redo | formatselect | bold italic forecolor | image | media | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | restoredraft | help",
        image_title: true,
        automatic_uploads: true,
        file_picker_types: "image file media",
        relative_urls: false,
        plugin_preview_max_width: 610,
        file_picker_callback: function (callback, value, meta) {
            var x =
                window.innerWidth ||
                document.documentElement.clientWidth ||
                document.getElementsByTagName("body")[0].clientWidth;
            var y =
                window.innerHeight ||
                document.documentElement.clientHeight ||
                document.getElementsByTagName("body")[0].clientHeight;
            var cmsURL = url +
                "/laravel-filemanager?field_name=" +
                meta.fieldname;
            if (meta.filetype == "image") {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: "Filemanager",
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no",
                onMessage: (api, message) => {
                    callback(message.content);
                },
            });
        },
        images_upload_handler: (blobInfo, success, failure) => {
            let formData = new FormData();
            formData.append("image", blobInfo.blob(), blobInfo.filename());
            axios
                .post(process.env.VUE_APP_API_BASE_URL + "/add-media", formData)
                .then((response) => {
                    let url_image =
                        process.env.VUE_APP_API_BASE_URL +
                        "/get-media/" +
                        response.data.location;
                    success(url_image);
                })
                .catch((error) => {
                    failure(error.message);
                });
        },
    });

    //Select Image

    $("#button-select-image").on("click", function (e) {
        e.preventDefault();
                var x =
                    window.innerWidth ||
                    document.documentElement.clientWidth ||
                    document.getElementsByTagName("body")[0].clientWidth;
                var y =
                    window.innerHeight ||
                    document.documentElement.clientHeight ||
                    document.getElementsByTagName("body")[0].clientHeight;
                var cmsURL = url +
                    "/laravel-filemanager?field_name=src&type=Images";
                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: "Filemanager",
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        $('#image-profile-card').attr('src', message.content); 
                        $('#image').attr('value', message.content);
                    },
                });
            
        
    })

    $("#select-image").on("click", function(e){
        e.preventDefault();
        var x =
            window.innerWidth ||
            document.documentElement.clientWidth ||
            document.getElementsByTagName("body")[0].clientWidth;
        var y =
            window.innerHeight ||
            document.documentElement.clientHeight ||
            document.getElementsByTagName("body")[0].clientHeight;
        var cmsURL = url +
            "/laravel-filemanager?field_name=src&type=Images";
        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: "Filemanager",
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                $('#select-image').attr('src', message.content);
                $('#image').attr('value', message.content);
            },
        });
    })
    $("#select-video").on("click", function(e){
        e.preventDefault();
        var x =
            window.innerWidth ||
            document.documentElement.clientWidth ||
            document.getElementsByTagName("body")[0].clientWidth;
        var y =
            window.innerHeight ||
            document.documentElement.clientHeight ||
            document.getElementsByTagName("body")[0].clientHeight;
        var cmsURL = url +
            "/laravel-filemanager?field_name=src&type=Files";
        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: "Filemanager",
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                $('#input-homeVideo').attr('value', message.content);
            },
        });
    })

    //Destroy Record


    $(document).on("click", '#delRecord', function (e) {
        e.preventDefault();
        
        let form = $(this).siblings()[1];
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        });
        

    })

    //Set today

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    $('#to').attr("max", today);
    $('#from').attr("max", today);




    // Dashboard Graph

    
    
    
    


    if ($('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
        let statistic = axios
            .get(url + '/index-dashboard')
            .then(response => {
                if (response.status == 200) {
                    //Tasks
                    dataCompletedTasksChart = {
                        labels: response.data.tasks_statistics.months,
                        series: response.data.tasks_statistics.series,
                    }
                    optionsCompletedTasksChart = {
                        lineSmooth: Chartist.Interpolation.cardinal({
                            tension: 0
                        }),
                        low: 0,
                        high: response.data.tasks_statistics.high, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
                        chartPadding: {
                            top: 0,
                            right: 0,
                            bottom: 0,
                            left: 0
                        }
                    }
                    var completedTasksChart = new Chartist.Bar('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

                    // start animation for the Completed Tasks Chart - Line Chart
                    md.startAnimationForBarChart(completedTasksChart);

                    //Visits


                    var dataWebsiteViewsChart = {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        series: response.data.visits_statistics.series
                    };
                    var optionsWebsiteViewsChart = {
                        low: 0,
                        high: response.data.visits_statistics.high,
                        chartPadding: {
                            top: 0,
                            right: 5,
                            bottom: 0,
                            left: 0
                        }
                    };
                    var responsiveOptions = [
                        ['screen and (max-width: 640px)', {
                            seriesBarDistance: 5,
                            axisX: {
                                labelInterpolationFnc: function (value) {
                                    return value[0];
                                }
                            }
                        }]
                    ];

                    var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);

                    //start animation for the Emails Subscription Chart
                    md.startAnimationForBarChart(websiteViewsChart);
                }
            })
            .catch(error => {
            })
        
        /* ----------==========     Daily Sales Chart initialization    ==========---------- */
        window.addEventListener("resize", function () { 
            
            statistic;
        
        }, true);
        statistic;

    }

    //Complete Tasks in Dashboard

    $(document).on("click", "#complete-task", function(e){
        e.preventDefault();


        let record = $(this).attr('value');

        axios
            .patch(url + '/complete-task/'+record)
            .then(response => {
                if (response.status == 200) {
                    if (response.data.error == null) {
                        Swal.fire(
                            'Completed!',
                            'Your task has been completed.',
                            'success'
                        )
                        

                    } else {
                        Swal.fire(
                            'Caution!',
                            response.data.error,
                            'warning'
                        )
                    }

                    $('#pending-tasks').html(response.data.view);
                }
            })
            .catch(error =>{
                Swal.fire(
                    'Caution!',
                    error.message,
                    'warning'
                )
            })
    })

})