
<style>
    body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .alert_modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 250px;
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .alert_modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* The Close Button */
        .alert_close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            margin-right: 10px;
            margin-top: -74px;
            cursor: pointer;
        }

        .alert_close:hover,
        .alert_close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .alert-header {
            color: red;
            background-color: white;
            padding: 10px;
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #888;
        }
        .alert-top-bar {
            background-color: red;
            height: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .alert-content {
            text-align: left;
            padding: 20px;
        }
        .alert-content p {
            margin: 10px 0;
        }
        .alert-content span {
            color: #007bff;
        }
        .alert-footer {
            text-align: center;
            padding: 14px;
        }
        .alert-footer button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 7px 15px;
            border-radius: 10px;
           
            cursor: pointer;
            font-size: 16px;
        }
        .alert-footer button:hover {
            background-color: #0056b3;
        }
        .show-alert-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .show-alert-button:hover {
            background-color: #0056b3;
        }
</style>

<div id="mySizeChartModal" class="alert_modal">
    <div class="alert_modal-content">
        <div class="alert-top-bar"></div>
        <div class="alert-header">
            Alert
        </div>
        <span class="alert_close" onclick="closeAlert()">&times;</span>
        <div class="alert-content">
           <p>Signals the presence of smoke in a specific area.</p>
        </div>
        <div class="alert-footer">
            <button onclick="closeAlert()">OK</button>
        </div>
    </div>
</div>



{{-- Added ashviniB --}}
<script>
    function showAlert() {
        document.getElementById('mySizeChartModal').style.display = 'block';
    }
    function closeAlert() {
        document.getElementById('mySizeChartModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('mySizeChartModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
{{-- End --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   
    function fetchAlarms() {
        $.ajax({
            url:  "{{ url('/admin/get-alarms') }}", 
            type: 'GET',
            success: function(response) {
                if (response.length > 0) {
                    response.forEach(function(alarm) {
                        const modalContent = `
                           <p>${alarm.message}</p>
                        `;
                        document.querySelector('.alert-content').innerHTML = modalContent;

                        showAlert();
                    });
                }
            },
            error: function(error) {
                console.log('Error fetching alarms:', error);
            }
        });
    }

   
        fetchAlarms();  
    

    setInterval(fetchAlarms, 600); 


    function showAlert() {
        document.getElementById('mySizeChartModal').style.display = 'block';
    }

    function closeAlert() {
        document.getElementById('mySizeChartModal').style.display = 'none';
    }

    window.onclick = function(event) {
        var modal = document.getElementById('mySizeChartModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>



