@extends('backend.sidebar')

@section('content')

<!-- CSS -->
<link href="{{ mix('css/backend/dashboard.css') }}" rel="stylesheet">
<!-- js -->
<script src="{{ mix('js/changelog.js') }}"></script>

<div class="section-header">
    <h1>Dashboard</h1>
    <h3><i class="fa-regular fa-calendar"></i><span id="datetime">Mon, 20 Jan 2023</span></h3>
</div>
<div class="all-data-container">
    <div class="data-item article">
        <div class="data-icon">
            <i class="fa-regular fa-newspaper fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>Article</p>
                    <h1>{{ $countData['article'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['article'] }}</h4>
        </div>
    </div>
    <div class="data-item tag">
        <div class="data-icon">
            <i class="fa-solid fa-tag fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>Tag</p>
                    <h1>{{ $countData['tag'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['tag'] }}</h4>
        </div>
    </div>
    <div class="data-item faq">
        <div class="data-icon">
            <i class="fa-solid fa-circle-question fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>FAQ</p>
                    <h1>{{ $countData['faq'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['faq'] }}</h4>
        </div>
    </div>
    <div class="data-item awards">
        <div class="data-icon">
            <i class="fa-solid fa-award fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>Awards</p>
                    <h1>{{ $countData['awards'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['awards'] }}</h4>
        </div>
    </div>
    <div class="data-item testimoni">
        <div class="data-icon">
            <i class="fa-regular fa-comment-dots fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>Testimoni</p>
                    <h1>{{ $countData['testimoni'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['testimoni'] }}</h4>
        </div>
    </div>
    <div class="data-item branch">
        <div class="data-icon">
            <i class="fa-solid fa-building fa-xl"></i>
        </div>
        <div class="data-data">
            <div>
                <div class="line"></div>
                <div>
                    <p>Branch</p>
                    <h1>{{ $countData['branch'] }}</h1>
                </div>
            </div>
            <h4>Last Change: {{ $lastChanges['branch'] }}</h4>
        </div>
    </div>
</div>

<div class="report-container">
    <div class="chart-container">
        <canvas id="acquisitions"></canvas>
    </div>
    <div class="recent-activity">
        <h3 id="test-animation">
            Recent Database Activities
        </h3>
        <div id="activity-container" class="activity-container">
            <!-- <div class="activity-item">
                <div class="activity-icon" style="background-color: var(--secondary-red100);">
                    <i class="fa-solid fa-trash fa-xl"></i>
                </div>
                <div class="activity-detail">
                    <p style="font-size: large;">Article</p>
                    <p style="font-size:smaller">2023-12-08 14:10:29</p>
                </div>
                <div class="data-detail">
                    <i class="fa-solid fa-info fa-2xs"></i>
                </div>
            </div> -->
        </div>
        <div id="preloader" class="text-center">
            <div class="spinner"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    async function fetchAnalytics() {
        let response = await fetch('analytics');
        let data = await response.json();
        setChart(data);

        return data;
    }

    fetchAnalytics();

    async function setChart(fetchResult) {
        const data = fetchResult

        // console.log(fetchResult);

        // fetchResult.forEach(item => {
        //     data.push({
        //         country: item.country,
        //         pageView: item.screenPageViews
        //     })   
        // });

        console.log(data);

        new Chart(
            document.getElementById('acquisitions'), {
                type: 'bar',
                data: {
                    labels: data.map(row => row.country),
                    datasets: [{
                        label: 'Screen Page Views',
                        data: data.map(row => row.screenPageViews),
                    }]
                },
            }
        );
    };
</script>

@endsection

@section('activePage', 'dashboard')