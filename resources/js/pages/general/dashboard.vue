<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Description -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="card bg-analytics text-white">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <img :src="BaseUrl+'/app-assets/images/elements/decore-left.png'" class="img-left" alt="card-img-left">
                                <img :src="BaseUrl+'/app-assets/images/elements/decore-right.png'" class="img-right" alt="card-img-right">
                                <div class="avatar avatar-xl bg-primary shadow mt-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-award white font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-2 text-white">Congratulations John,</h1>
                                    <p class="m-auto w-75">You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-primary font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">92.6k</h2>
                            <p class="mb-0">Subscribers Gained</p>
                        </div>
                        <div class="card-content" style="position: relative;">
                            <div id="subscribe-gain-chart" style="min-height: 100px;"><div id="apexchartsrrlcwi26g" class="apexcharts-canvas apexchartsrrlcwi26g light" style="width: 236px; height: 100px;"><svg id="SvgjsSvg1286" width="236" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1288" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1287"><clipPath id="gridRectMaskrrlcwi26g"><rect id="SvgjsRect1292" width="238.5" height="102.5" x="-1.25" y="-1.25" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMaskrrlcwi26g"><rect id="SvgjsRect1293" width="238" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1299" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1300" stop-opacity="0.7" stop-color="rgba(115,103,240,0.7)" offset="0"></stop><stop id="SvgjsStop1301" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="0.8"></stop><stop id="SvgjsStop1302" stop-opacity="0.5" stop-color="rgba(241,240,254,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1291" x1="38.83333333333333" y1="0" x2="38.83333333333333" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="38.83333333333333" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1305" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1306" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1309" class="apexcharts-grid"><line id="SvgjsLine1311" x1="0" y1="100" x2="236" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1310" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1295" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1296" class="apexcharts-series" seriesName="Subscribers" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1303" d="M 0 100L 0 77.77777777777777C 13.766666666666664 77.77777777777777 25.566666666666663 51.111111111111114 39.33333333333333 51.111111111111114C 53.099999999999994 51.111111111111114 64.89999999999999 60 78.66666666666666 60C 92.43333333333332 60 104.23333333333332 24.444444444444443 117.99999999999999 24.444444444444443C 131.76666666666665 24.444444444444443 143.56666666666666 55.55555555555556 157.33333333333331 55.55555555555556C 171.1 55.55555555555556 182.89999999999998 6.666666666666657 196.66666666666666 6.666666666666657C 210.4333333333333 6.666666666666657 222.23333333333332 17.777777777777786 235.99999999999997 17.777777777777786C 235.99999999999997 17.777777777777786 235.99999999999997 17.777777777777786 235.99999999999997 100M 235.99999999999997 17.777777777777786z" fill="url(#SvgjsLinearGradient1299)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskrrlcwi26g)" pathTo="M 0 100L 0 77.77777777777777C 13.766666666666664 77.77777777777777 25.566666666666663 51.111111111111114 39.33333333333333 51.111111111111114C 53.099999999999994 51.111111111111114 64.89999999999999 60 78.66666666666666 60C 92.43333333333332 60 104.23333333333332 24.444444444444443 117.99999999999999 24.444444444444443C 131.76666666666665 24.444444444444443 143.56666666666666 55.55555555555556 157.33333333333331 55.55555555555556C 171.1 55.55555555555556 182.89999999999998 6.666666666666657 196.66666666666666 6.666666666666657C 210.4333333333333 6.666666666666657 222.23333333333332 17.777777777777786 235.99999999999997 17.777777777777786C 235.99999999999997 17.777777777777786 235.99999999999997 17.777777777777786 235.99999999999997 100M 235.99999999999997 17.777777777777786z" pathFrom="M -1 140L -1 140L 39.33333333333333 140L 78.66666666666666 140L 117.99999999999999 140L 157.33333333333331 140L 196.66666666666666 140L 235.99999999999997 140"></path><path id="SvgjsPath1304" d="M 0 77.77777777777777C 13.766666666666664 77.77777777777777 25.566666666666663 51.111111111111114 39.33333333333333 51.111111111111114C 53.099999999999994 51.111111111111114 64.89999999999999 60 78.66666666666666 60C 92.43333333333332 60 104.23333333333332 24.444444444444443 117.99999999999999 24.444444444444443C 131.76666666666665 24.444444444444443 143.56666666666666 55.55555555555556 157.33333333333331 55.55555555555556C 171.1 55.55555555555556 182.89999999999998 6.666666666666657 196.66666666666666 6.666666666666657C 210.4333333333333 6.666666666666657 222.23333333333332 17.777777777777786 235.99999999999997 17.777777777777786" fill="none" fill-opacity="1" stroke="#4d8135" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskrrlcwi26g)" pathTo="M 0 77.77777777777777C 13.766666666666664 77.77777777777777 25.566666666666663 51.111111111111114 39.33333333333333 51.111111111111114C 53.099999999999994 51.111111111111114 64.89999999999999 60 78.66666666666666 60C 92.43333333333332 60 104.23333333333332 24.444444444444443 117.99999999999999 24.444444444444443C 131.76666666666665 24.444444444444443 143.56666666666666 55.55555555555556 157.33333333333331 55.55555555555556C 171.1 55.55555555555556 182.89999999999998 6.666666666666657 196.66666666666666 6.666666666666657C 210.4333333333333 6.666666666666657 222.23333333333332 17.777777777777786 235.99999999999997 17.777777777777786" pathFrom="M -1 140L -1 140L 39.33333333333333 140L 78.66666666666666 140L 117.99999999999999 140L 157.33333333333331 140L 196.66666666666666 140L 235.99999999999997 140"></path><g id="SvgjsG1297" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1317" r="0" cx="39.33333333333333" cy="51.111111111111114" class="apexcharts-marker wpud5cvvlg no-pointer-events" stroke="#ffffff" fill="#4d8135" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1298" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1312" x1="0" y1="0" x2="236" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1313" x1="0" y1="0" x2="236" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1314" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1315" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1316" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1290" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1307" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1308" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light" style="left: 50px; top: 54px;"><div class="apexcharts-tooltip-series-group active" style="display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(115, 103, 240);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Subscribers: </span><span class="apexcharts-tooltip-text-value">40</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-package text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">97.5K</h2>
                            <p class="mb-0">Orders Received</p>
                        </div>
                        <div class="card-content" style="position: relative;">
                            <div id="orders-received-chart" style="min-height: 100px;"><div id="apexcharts29k7m2t8" class="apexcharts-canvas apexcharts29k7m2t8 light" style="width: 236px; height: 100px;"><svg id="SvgjsSvg1321" width="236" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1323" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1322"><clipPath id="gridRectMask29k7m2t8"><rect id="SvgjsRect1327" width="238.5" height="102.5" x="-1.25" y="-1.25" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><clipPath id="gridRectMarkerMask29k7m2t8"><rect id="SvgjsRect1328" width="238" height="102" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect></clipPath><linearGradient id="SvgjsLinearGradient1334" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1335" stop-opacity="0.7" stop-color="rgba(255,159,67,0.7)" offset="0"></stop><stop id="SvgjsStop1336" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="0.8"></stop><stop id="SvgjsStop1337" stop-opacity="0.5" stop-color="rgba(255,245,236,0.5)" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1326" x1="0" y1="0" x2="0" y2="100" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="100" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><g id="SvgjsG1340" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1341" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1344" class="apexcharts-grid"><line id="SvgjsLine1346" x1="0" y1="100" x2="236" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1345" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1330" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1331" class="apexcharts-series" seriesName="Orders" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1338" d="M 0 100L 0 60C 13.766666666666664 60 25.566666666666663 10 39.33333333333333 10C 53.099999999999994 10 64.89999999999999 80 78.66666666666666 80C 92.43333333333332 80 104.23333333333332 10 117.99999999999999 10C 131.76666666666665 10 143.56666666666666 90 157.33333333333331 90C 171.1 90 182.89999999999998 40 196.66666666666666 40C 210.4333333333333 40 222.23333333333332 80 235.99999999999997 80C 235.99999999999997 80 235.99999999999997 80 235.99999999999997 100M 235.99999999999997 80z" fill="url(#SvgjsLinearGradient1334)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask29k7m2t8)" pathTo="M 0 100L 0 60C 13.766666666666664 60 25.566666666666663 10 39.33333333333333 10C 53.099999999999994 10 64.89999999999999 80 78.66666666666666 80C 92.43333333333332 80 104.23333333333332 10 117.99999999999999 10C 131.76666666666665 10 143.56666666666666 90 157.33333333333331 90C 171.1 90 182.89999999999998 40 196.66666666666666 40C 210.4333333333333 40 222.23333333333332 80 235.99999999999997 80C 235.99999999999997 80 235.99999999999997 80 235.99999999999997 100M 235.99999999999997 80z" pathFrom="M -1 160L -1 160L 39.33333333333333 160L 78.66666666666666 160L 117.99999999999999 160L 157.33333333333331 160L 196.66666666666666 160L 235.99999999999997 160"></path><path id="SvgjsPath1339" d="M 0 60C 13.766666666666664 60 25.566666666666663 10 39.33333333333333 10C 53.099999999999994 10 64.89999999999999 80 78.66666666666666 80C 92.43333333333332 80 104.23333333333332 10 117.99999999999999 10C 131.76666666666665 10 143.56666666666666 90 157.33333333333331 90C 171.1 90 182.89999999999998 40 196.66666666666666 40C 210.4333333333333 40 222.23333333333332 80 235.99999999999997 80" fill="none" fill-opacity="1" stroke="#ff9f43" stroke-opacity="1" stroke-linecap="butt" stroke-width="2.5" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask29k7m2t8)" pathTo="M 0 60C 13.766666666666664 60 25.566666666666663 10 39.33333333333333 10C 53.099999999999994 10 64.89999999999999 80 78.66666666666666 80C 92.43333333333332 80 104.23333333333332 10 117.99999999999999 10C 131.76666666666665 10 143.56666666666666 90 157.33333333333331 90C 171.1 90 182.89999999999998 40 196.66666666666666 40C 210.4333333333333 40 222.23333333333332 80 235.99999999999997 80" pathFrom="M -1 160L -1 160L 39.33333333333333 160L 78.66666666666666 160L 117.99999999999999 160L 157.33333333333331 160L 196.66666666666666 160L 235.99999999999997 160"></path><g id="SvgjsG1332" class="apexcharts-series-markers-wrap"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1352" r="0" cx="0" cy="0" class="apexcharts-marker wlrb2g4js no-pointer-events" stroke="#ffffff" fill="#ff9f43" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle></g></g><g id="SvgjsG1333" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine1347" x1="0" y1="0" x2="236" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1348" x1="0" y1="0" x2="236" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1349" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1350" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1351" class="apexcharts-point-annotations"></g></g><rect id="SvgjsRect1325" width="0" height="0" x="0" y="0" rx="0" ry="0" fill="#fefefe" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect><g id="SvgjsG1342" class="apexcharts-yaxis" rel="0" transform="translate(-21, 0)"><g id="SvgjsG1343" class="apexcharts-yaxis-texts-g"></g></g></svg><div class="apexcharts-legend"></div><div class="apexcharts-tooltip light"><div class="apexcharts-tooltip-series-group"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 159, 67);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Description -->
        <section id="statistics-card">
            <div class="row">
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-eye text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">36.9k</h2>
                                <p class="mb-0 line-ellipsis">Views</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-message-square text-warning font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">12k</h2>
                                <p class="mb-0 line-ellipsis">Comments</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-shopping-bag text-danger font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">97.8k</h2>
                                <p class="mb-0 line-ellipsis">Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-heart text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">26.8</h2>
                                <p class="mb-0 line-ellipsis">Bookmarks</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-award text-success font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">689</h2>
                                <p class="mb-0 line-ellipsis">Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-truck text-danger font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">2.1k</h2>
                                <p class="mb-0 line-ellipsis">Returns</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
                    
                </section>
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("home") };
  },
};
</script>
<style scoped>
/*========================================================
        DARK LAYOUT
=========================================================*/
#dashboard-analytics .img-left {
  width : 200px;
  position : absolute;
  top : 0;
  left : 0;
}

#dashboard-analytics .img-right {
  width : 175px;
  position : absolute;
  top : 0;
  right : 0;
}

#dashboard-analytics .bg-analytics {
  background : -webkit-linear-gradient(332deg, #4d8135, rgb(77 129 53));
  background :         linear-gradient(118deg, #4d8135, rgb(77 129 53));
}
#dashboard-analytics .bg-analytics .avatar {
  margin-bottom : 2rem;
}

#dashboard-analytics table tr th:first-child, #dashboard-analytics table tr td:first-child {
  padding-left : 2rem;
}

#dashboard-analytics table tr th:last-child, #dashboard-analytics table tr td:last-child {
  padding-right : 2rem;
}

#dashboard-analytics table td {
  padding : 0.75rem;
}

@media only screen and (max-width: 576px) {
  #dashboard-analytics .img-left, #dashboard-analytics .img-right {
    width : 140px;
  }
}
</style>