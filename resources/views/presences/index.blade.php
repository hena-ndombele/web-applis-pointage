@extends('layouts.app')
@section('title')
    <span>Liste de présence</span>
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">

      <div class="col-12">
          <div class="card">
              <div class="card-body">

                <div class="row mb-4">
                    <form action="{{ route('presences.index') }}" method="get">
                        <div class="form-group">
                            <label for="month">Mois et années :</label>
                            <input type="month" id="month" name="month" class="form-control" value="{{ $month }}">
                        </div>
                        <button type="submit" class="btn " style="background: black;color:white;">Afficher</button>
                    </form>
                </div>
            



                <div class="row">
                    <div class="col-12">
                        <!-- Calendar show -->
                        <div class="card " style="background: #008B8B;color:white;">
                            <div class="card-header border-0">
                    
                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo date('F Y', $date); ?>
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn  btn-sm dropdown-toggle" data-toggle="dropdown" style="background: black;color:white;">
                                        <i class="fas fa-bars"></i></button>
                                        <div class="dropdown-menu float-right" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn  btn-sm" data-card-widget="collapse" style="background: black;color:white;">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn  btn-sm" data-card-widget="remove" style="background: black;color:white;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div class="col-12 calendar">
                                
                                    <div class="card">
                                      <div class="card-header">
                                          <div class="row">
                                            <div class="col-4">
                                                <a href="?month=<?php echo date('Y-m', strtotime('-1 month', strtotime($month))); ?>">&lt;</a>
                                            </div>
                                            <div class="col-4 text-center">
                                                <?php echo date('F Y', $date); ?>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="?month=<?php echo date('Y-m', strtotime('+1 month', strtotime($month))); ?>">&gt;</a>
                                            </div>
                                          </div>
                                    
                                          <div class="card-body">
                                              <div class="row">
                                              <?php foreach ($dates as $date) { ?>
                                                  <div class="col-2 text-center">
                                                  <div class="date <?php echo $date['day'] ? 'day' : ''; ?>">
                                                      <a href="{{ route('show_presences', ['date' => $date['date']]) }}" class="text-secondary"><?php echo $date['day']; ?></a>
                                                  
                                                  </div>
                                                  </div>
                                              <?php } ?>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
      </div>

    </div>
</section >  
    

    
    <style>
        .card-body{
            background-color: #fff !important;
            color: #000;
        }
        .calendar {
            font-family: Arial, sans-serif;
            /* border: 1px solid #ccc; */
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }

        .month {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .days {
            display: flex;
        }

        .day {
            flex: 1;
            text-align: center;
        }

        .dates {
            display: flex;
            flex-wrap: wrap;
        }

        .date {
            flex-basis: calc(100% / 7);
            padding: 10px;
            text-align: center;
        }

        .date.empty {
            visibility: hidden;
        }

    </style>
    <!-- /.card -->
    
    
    

       
  
@endsection
