<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notification</title>
    <!-- Add your CSS or link to Bootstrap here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create Test Notification</h2>

        <!-- Show success message if exists -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form to insert a notification -->
        <form action="{{ route('notification.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="device_id" class="form-label">Device ID</label>
                <input type="text" class="form-control" id="device_id" name="device_id" required>
            </div>
            <div class="mb-3">
                <label for="device_type" class="form-label">Device Type</label>
                <input type="text" class="form-control" id="device_type" name="device_type" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Alert Message</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
