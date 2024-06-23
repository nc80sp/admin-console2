<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>管理画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            text-align: center;
            white-space: nowrap;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }
        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>
    <link href="/sidebars.css" rel="stylesheet">
</head>
<body>
<main >
    <div class="container">
        <div class="row">
            <header class="p-2 text-bg-dark">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <img class="mb-1" src="/logo.png" alt="" width="66" height="40">
                        <span class="col-12 col-lg-auto me-lg-auto justify-content-center fw-semibold display-6 text-light">ゲームデータ管理ツール</span>

                        <div class="text-end">
                            <button type="button" class="btn btn-warning" onclick="location.href='{{route("auth.logout")}}'">ログアウト</button>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div class="row">
            <div class="col-3 ">
                <div class=" flex-shrink-0 p-3" style="width: 250px;">
                    <ul class="list-unstyled ps-0">
                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse"
                            @if (isset($itemList))
                                    aria-expanded="true"
                            @else
                                    aria-expanded="true"
                            @endif
                            >
                                マスタデータ
                            </button>
                            @if (isset($itemList))
                            <div class="collapse show" id="dashboard-collapse">
                            @else
                            <div class="collapse show" id="dashboard-collapse">
                            @endif
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @if (isset($itemList))
                                        <li><a href="{{route('items.index')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded bg-primary text-light">アイテム一覧</a></li>
                                    @else
                                        <li><a href="{{route('items.index')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded">アイテム一覧</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="true">
                                ユーザーデータ
                            </button>
                            @if (isset($userList) || isset($haveItemList))
                            <div class="collapse show" id="orders-collapse">
                            @else
                            <div class="collapse show" id="orders-collapse">
                            @endif
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @if (isset($userList))
                                        <li><a href="{{route('users.index')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded bg-primary text-light">ユーザー一覧</a></li>
                                    @else
                                        <li><a href="{{route('users.index')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded">ユーザー一覧</a></li>
                                    @endif
                                    @if (isset($haveItemList))
                                    <li><a href="{{route('users.showItem')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded bg-primary text-light">所持アイテム</a></li>
                                    @else
                                    <li><a href="{{route('users.showItem')}}" class="link-body-emphasis d-inline-flex text-decoration-none rounded">所持アイテム</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse"
                                    @if (isset($accountList) || isset($accountAdd) || isset($accountRemove))
                                        aria-expanded="true"
                                    @else
                                        aria-expanded="true"
                                    @endif
                            >
                                アカウント
                            </button>
                            @if (isset($accountList) || isset($accountAdd) || isset($accountRemove))
                                <div class="collapse show" id="account-collapse">
                            @else
                                <div class="collapse show" id="account-collapse">
                            @endif
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    @if(isset($accountList))
                                        <li><a href="{{route('accounts.index')}}" class="link-dark d-inline-flex text-decoration-none rounded bg-primary text-light">管理者一覧</a></li>
                                    @else
                                        <li><a href="{{route('accounts.index')}}" class="link-dark d-inline-flex text-decoration-none rounded">管理者一覧</a></li>
                                    @endif
                                    @if(isset($accountAdd))
                                        <li><a href="{{route('accounts.create')}}" class="link-dark d-inline-flex text-decoration-none rounded bg-primary text-light">管理者の追加</a></li>
                                    @else
                                        <li><a href="{{route('accounts.create')}}" class="link-dark d-inline-flex text-decoration-none rounded">管理者の追加</a></li>
                                    @endif
                                    <li><a href="{{route('auth.logout')}}" class="link-dark d-inline-flex text-decoration-none rounded">ログアウト</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-9 " >
                <br>
                @yield('content')
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
