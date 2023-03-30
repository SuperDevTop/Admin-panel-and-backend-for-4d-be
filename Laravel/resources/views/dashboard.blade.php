
@include('common')
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div style="height: 15%"></div>
                    <button type="submit" class="btn btn-primary w-100 h-25 mb-5 mt-5" onclick="toPoints()"><h3> Points Movement </button>
                    <button type="submit" class="btn btn-primary w-100 h-25 mb-5 mt-5" onclick="toActivities()"><h3> Activities </button>
                    <button type="submit" class="btn btn-primary w-100 h-25 mb-5 mt-5" onclick="toExcess()"><h3> Excess Amount </button>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </body>
</html>

<script>
    function toActivities(){
        window.location = '/activities'
    }

    function toExcess(){
        window.location = '/excessamount'
    }

    function toPoints(){
        window.location = '/pointsmovement'
    }
</script>
