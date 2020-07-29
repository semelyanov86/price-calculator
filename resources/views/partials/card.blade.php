<div class="card mt-2">
    <div class="card-body">
        <h5 class="card-title">{{$item->package_name}}</h5>
        <div class="row">
            <div class="col-sm-3 text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-coins"></i>
                </span>
                <div>
                    {{$item->package_month_price}}
                </div>
            </div>
            <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-sms"></i>
                </span>
                <div>
                    {{$item->package_sms}}
                </div>
            </div>
            <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-phone"></i>
                </span>
                <div>
                    {{$item->package_minutes}}
                </div>
            </div>
            <div class="col-sm-3  text-center">
                <span style="font-size: 3em; color: Dodgerblue;">
                    <i class="fas fa-wifi"></i>
                </span>
                <div>
                    {{$item->package_gb}}
                </div>
            </div>
        </div>
    </div>
</div>
