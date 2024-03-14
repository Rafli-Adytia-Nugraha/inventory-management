<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="{{ asset('logo.png') }}" width="110" height="32" alt="Tabler"
                    class="navbar-brand-image">
            </a>
        </h1>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ Route::is('dashboard.index') ? 'active' : '' }}">
                    {{-- <a class="nav-link" href="{{ route('page.dashboard.index') }}"> --}}
                    <a class="nav-link" href="{{ 0 }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/dashboard</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="13" r="2"></circle>
                                <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>
                {{-- @can('user-management') --}}
                    <li class="nav-item {{ Route::is('user.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <desc>Download more icon variants from https://tabler-icons.io/i/users</desc>
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                User
                            </span>
                        </a>
                    </li>
                {{-- @endcan --}}
                <li
                    class="nav-item dropdown {{ Route::is('change-request.*') ? 'active' : '' }} {{ Route::is('goods-receive.*') ? 'active' : '' }} {{ Route::is('download.*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button"
                        aria-expanded="{{ Route::is('change-request.*') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/package -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-database"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <desc>Download more icon variants from https://tabler-icons.io/i/database</desc>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                <path d="M4 6v6a8 3 0 0 0 16 0v-6"></path>
                                <path d="M4 12v6a8 3 0 0 0 16 0v-6"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Data Master
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ Route::is('change-request.*') || Route::is('database-general.*') || Route::is('job.*') || Route::is('integration.*') || Route::is('download.*') ? 'show' : '' }} {{ Route::is('goods-receive.*') ? 'show' : '' }} {{ Route::is('BOQ.*') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <div class="dropend">
                                {{-- @can('jugling-management') --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('change-request.po-bulk-index') || Route::is('change-request.breakdown-po-index') || Route::is('change-request.summary-po-index') || Route::is('change-request.po-tracking-index') || Route::is('change-request.job-list') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('change-request.po-bulk-index') || Route::is('change-request.breakdown-po-index') || Route::is('change-request.summary-po-index') || Route::is('change-request.po-tracking-index') || Route::is('change-request.job-list') ? 'true' : 'false' }}">
                                                PO Database Bulk & Ma...
                                        </a>
                                        <div
                                            class="dropdown-menu {{ Route::is('change-request.po-bulk-index') || Route::is('change-request.breakdown-po-index') || Route::is('change-request.summary-po-index') || Route::is('change-request.po-tracking-index') || Route::is('change-request.job-list') ? 'show' : '' }}">
                                            <a href="{{ route('change-request.po-bulk-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.po-bulk-index') ? 'active' : '' }}">PO
                                                Bulk</a>
                                            <a href="{{ route('change-request.breakdown-po-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.breakdown-po-index') ? 'active' : '' }}">Breakdown
                                                PO</a>
                                            <a href="{{ route('change-request.summary-po-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.summary-po-index') ? 'active' : '' }}">Design BOQ</a>
                                            <a href="{{ route('change-request.po-tracking-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.po-tracking-index') ? 'active' : '' }}">PO
                                                Tracking</a>
                                            <a href="{{ route('change-request.job-list') }}"
                                                class="dropdown-item {{ Route::is('change-request.job-list') ? 'active' : '' }}">
                                                Queue</a>
                                        </div>
                                    {{-- @endcan --}}

                                    {{-- @can('jugling-management') --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('change-request.po-number.index') || Route::is('change-request.po-tracking-general-index') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('change-request.po-number.index') || Route::is('change-request.po-tracking-general-index') ? 'true' : 'false' }}">
                                            PO Database General
                                        </a>
                                        <div
                                            class="dropdown-menu {{ Route::is('change-request.po-number.index') || Route::is('change-request.po-tracking-general-index') ? 'show' : '' }}">
                                            <a href="{{ route('change-request.po-number.index') }}"
                                                class="dropdown-item {{ Route::is('change-request.po-number.index') ? 'active' : '' }}">PO
                                                Number</a>
                                            <a href="{{ route('change-request.po-tracking-general-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.po-tracking-general-index') ? 'active' : '' }}">PO
                                                Tracking</a>
                                        </div>
                                    {{-- @endcan --}}
                                
                                    {{-- @can('jugling-management') --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('change-request.index') || Route::is('change-request.boq-index') || Route::is('job.*') || Route::is('integration.*') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('change-request.index') || Route::is('change-request.boq-index') || Route::is('integration.*') ? 'true' : 'false' }}">
                                            PO Database
                                        </a>
                                        <div
                                            class="dropdown-menu {{ Route::is('change-request.index') || Route::is('change-request.boq-index') || Route::is('job.*') || Route::is('integration.*') ? 'show' : '' }}">
                                            <a href="{{ route('change-request.index') }}"
                                                class="dropdown-item {{ Route::is('change-request.index') ? 'active' : '' }}">Upload</a>
                                            <a href="{{ route('change-request.boq-index') }}"
                                                class="dropdown-item {{ Route::is('change-request.boq-index') ? 'active' : '' }}">Bill
                                                of Quantity</a>
                                            <a href="{{ route('integration.index') }}"
                                                class="dropdown-item {{ Route::is('integration.*') ? 'active' : '' }}">Change
                                                Request</a>
                                        </div>
                                    {{-- @endcan
                                    @canany(['gr-management', 'gr-export']) --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('goods-receive.*') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('goods-receive.*') ? 'true' : 'false' }}">
                                            Goods Receive
                                        </a>
                                        <div class="dropdown-menu  {{ Route::is('goods-receive.*') ? 'show' : '' }}">
                                            {{-- @can('gr-management') --}}
                                                <a href="{{ route('goods-receive.source-project-code.index') }}"
                                                    class="dropdown-item {{ Route::is('goods-receive.source-project-code.index') ? 'active' : '' }}">Source
                                                    Project Code</a>
                                                <a href="{{ route('goods-receive.transmital-form.index') }}"
                                                    class="dropdown-item {{ Route::is('goods-receive.transmital-form.index') ? 'active' : '' }}">Transmital
                                                    Form</a>
                                            {{-- @endcan
                                            @can('gr-export') --}}
                                                <a href="{{ route('goods-receive.gr-export.index') }}"
                                                    class="dropdown-item {{ Route::is('goods-receive.gr-export.*') ? 'active' : '' }}">GR
                                                    Export</a>
                                            {{-- @endcan --}}
                                        </div>
                                    {{-- @endcanany --}}

                                    {{-- @canany(['master-rules-listCode-boq', 'input-output-boq']) --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('BOQ.*') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('BOQ.*') ? 'true' : 'false' }}">
                                            BOQ
                                        </a>
                                    {{-- @endcanany --}}
                                    <div class="dropdown-menu  {{ Route::is('BOQ.*') ? 'show' : '' }}">
                                        {{-- @can('master-rules-listCode-boq') --}}
                                            <a href="{{ route('BOQ.masterDataBoq.boq.index') }}"
                                                class="dropdown-item {{ Route::is('BOQ.masterDataBoq.boq.*') ? 'active' : '' }}">Master
                                                Data BOQ</a>
                                            <a href="{{ route('BOQ.listCode.index') }}"
                                                class="dropdown-item {{ Route::is('BOQ.listCode.*') ? 'active' : '' }}">List
                                                Code BOQ</a>
                                            <a href="{{ route('BOQ.rules.index') }}"
                                                class="dropdown-item {{ Route::is('BOQ.rules.*') ? 'active' : '' }}">Rules
                                                BOQ</a>
                                        {{-- @endcan
                                        @can('input-output-boq') --}}
                                            <a href="{{ route('BOQ.needBoq.boq') }}"
                                                class="dropdown-item {{ Route::is('BOQ.needBoq.*') ? 'active' : '' }}">Need
                                                BOQ</a>
                                            <a href="{{ route('BOQ.outputBoq.index') }}"
                                                class="dropdown-item {{ Route::is('BOQ.outputBoq.*') ? 'active' : '' }}">Output
                                                BOQ</a>
                                            <a href="{{ route('BOQ.pilihanBoq.index') }}"
                                                class="dropdown-item {{ Route::is('BOQ.pilihanBoq.*') ? 'active' : '' }}">Pilihan
                                                BOQ</a>
                                        {{-- @endcan --}}
                                    </div>
                                    {{-- @can('jugling-management') --}}
                                        <a class="dropdown-item dropdown-toggle {{ Route::is('download.*') ? 'active' : '' }} "
                                            href="#" data-bs-toggle="dropdown" role="button"
                                            aria-expanded="{{ Route::is('download.*') || Route::is('integration.*') ? 'true' : 'false' }}">
                                            Download
                                        </a>
                                        <div
                                            class="dropdown-menu {{ Route::is('download.*') ? 'show' : '' }}">
                                            <a href="{{ route('download.boq.index') }}" class="dropdown-item {{ Route::is('download.boq.index') ? 'active' : '' }}">BOQ </a>
                                            <a href="{{ route('download.implementasi.index') }}" class="dropdown-item {{ Route::is('download.implementasi.index') ? 'active' : '' }}">Status Implementasi</a>
                                            <a href="{{ route('download.atp.index') }}" class="dropdown-item {{ Route::is('download.atp.index') ? 'active' : '' }}">ATP</a>
                                            <a href="{{ route('download.tf.index') }}" class="dropdown-item {{ Route::is('download.tf.index') ? 'active' : '' }}">TF</a>
                                        </div>
                                    {{-- @endcan --}}
                                </div>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
