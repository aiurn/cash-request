@extends('layouts.app')

@push('styles')
@endpush

@section('container')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data bg-head-up text-white style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/setting.png') }}" width="40" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Settings</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/gateway.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Device</h5>
                    <p class="card-text">Device Status,Device IP,Connection,Port,Tag Address</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/sensor.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Sensors</h5>
                    <p class="card-text">Sensor Name,Sensor display, Config Sensor</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/api-setting.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">API</h5>
                    <p class="card-text">Station ID,API JWT Key</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/socket.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Socket</h5>
                    <p class="card-text">Websocket Setting,Realtime,Interval Pool</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/alarm.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Alarm</h5>
                    <p class="card-text">Alarm Setting</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='{{ route('settings.user.index') }}';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/users.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Create, Read, Update, Delete user</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='{{ route('settings.department.index') }}';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/departement-2.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Department</h5>
                    <p class="card-text">Create, Read, Update, Departements and Privileges</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/database.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Database</h5>
                    <p class="card-text">Host Setting, User Name, Database, Logger Interval,Backup</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/resend.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Resend</h5>
                    <p class="card-text">resend data to klhk from import excel.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/privilege.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Privilege</h5>
                    <p class="card-text">Create, read, update privilege.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/other.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Other</h5>
                    <p class="card-text">Plant Name</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12 p-1" onclick="location.href='#';">
        <div class="card master-data style--radius15">
            <div class="card-body d-flex justify-content-start align-items-center">
                <div style="padding-left: 10px;">
                    <img src="{{ asset('assets/images/icon/goiot.png') }}" width="60" alt="">
                </div>                            
                <div style="padding-left: 20px;">
                    <h5 class="card-title">Goiot</h5>
                    <p class="card-text">Cloud Setting, Database Sync, Cloud Logger</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    
@endpush