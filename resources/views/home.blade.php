@extends('layouts.app')

@section('content')
<div class="cards-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Card -->
                <a href="/workouts">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/calendar.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Workouts</h4>
                            <p>Manage your existing workouts</p>
                        </div>
                    </div>
                </a>
                <!-- end of card -->

                <!-- Card -->
                <a href="/workouts/create">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/dumbbells.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">New workout</h4>
                            <p>Create a new workout</p>
                        </div>
                    </div>
                </a>
                <!-- end of card -->

                <!-- Card -->
                <a href="/analysis/exercise">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/progress.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Progress</h4>
                            <p>Track your progress</p>
                        </div>
                    </div>
                </a>
                <!-- end of card -->

                <!-- Card -->
                <a href="/exercises">
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="images/exercises.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Exercises</h4>
                            <p>Manage the available exercises</p>
                        </div>
                    </div>
                </a>
                <!-- end of card -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
@endsection
