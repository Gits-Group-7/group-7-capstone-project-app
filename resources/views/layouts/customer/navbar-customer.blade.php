<!--Main Navigation-->
<header class="fixed-top">
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="row gy-3">
                <!-- Left elements -->
                <div class="col-lg-2 col-sm-4 col-4 d-flex">
                    <a href="{{ route('customer.beranda') }}" target="_blank" class="float-start my-auto">
                        <img class="logo-1 img-fluid" src="{{ asset('admin/images/print-shop-logo-title.png') }}" />
                        <img class="logo-2 img-fluid" src="{{ asset('admin/images/print-shop-logo.png') }}" />
                    </a>
                </div>
                <!-- Left elements -->

                <!-- Center elements -->
                <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                    <div class="d-flex float-end p-3">
                        <a href="{{ route('customer.store') }}"
                            class="btn-theme me-1 py-1 px-3 nav-link d-flex align-items-center">
                            <i class="fa-solid fa-store m-1 me-md-2"></i>
                            <p class="d-none d-md-block mb-0">Toko</p>
                        </a>
                        <a href="{{ route('cart.index') }}"
                            class="btn-theme me-1 py-1 px-3 nav-link d-flex align-items-center">
                            <i class="fas fa-shopping-cart m-1 me-md-2"></i>
                            <p class="d-none d-md-block mb-0">Keranjang</p>
                        </a>
                        @if (auth()->user() != null && auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">{{ Auth::user()->name }}</p>
                            </a>
                        @elseif (Auth()->user() != null && auth()->user()->role == 'customer')
                            <a href="{{ route('customer.profile', Auth::user()->id) }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">{{ Auth::user()->name }}</p>
                            </a>
                        @else
                            <a href="{{ route('customer.login') }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">Login</p>
                            </a>
                        @endif

                    </div>
                </div>
                <!-- Center elements -->

                {{-- Search Component --}}
                <div class="col-lg-5 col-md-12 col-12 d-flex">
                    <div class="input-group float-center my-auto">
                        <div class="form-outline">
                            <input type="search" id="search-input" name="search-input" class="form-control"
                                placeholder="Temukan produk dan jasa yang Anda butuhkan!"
                                value="{{ session('searchTerm') }}" />
                        </div>
                        <button type="button" class="btn search-theme shadow-0" onclick="searchProductAndService()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <script>
                    function searchProductAndService() {
                        var searchTerm = document.getElementById('search-input').value;
                        window.location.href = '{{ route('customer.search') }}?query=' + encodeURIComponent(searchTerm);
                    }
                </script>

                <script>
                    function autocomplete(inp, arr) {
                        /*the autocomplete function takes two arguments,
                        the text field element and an array of possible autocompleted values:*/
                        var currentFocus;
                        /*execute a function when someone writes in the text field:*/
                        inp.addEventListener("input", function(e) {
                            var a, b, i, val = this.value;
                            /*close any already open lists of autocompleted values*/
                            closeAllLists();
                            if (!val) {
                                return false;
                            }
                            currentFocus = -1;
                            /*create a DIV element that will contain the items (values):*/
                            a = document.createElement("DIV");
                            a.setAttribute("id", this.id + "autocomplete-list");
                            a.setAttribute("class", "autocomplete-items text-justify");
                            /*append the DIV element as a child of the autocomplete container:*/
                            this.parentNode.appendChild(a);
                            /*for each item in the array...*/
                            for (i = 0; i < arr.length; i++) {
                                /*check if the item starts with the same letters as the text field value:*/
                                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                                    /*create a DIV element for each matching element:*/
                                    b = document.createElement("DIV");
                                    /*make the matching letters bold:*/
                                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                                    b.innerHTML += arr[i].substr(val.length);
                                    /*insert a input field that will hold the current array item's value:*/
                                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                                    /*execute a function when someone clicks on the item value (DIV element):*/
                                    b.addEventListener("click", function(e) {
                                        /*insert the value for the autocomplete text field:*/
                                        inp.value = this.getElementsByTagName("input")[0].value;
                                        /*close the list of autocompleted values,
                                        (or any other open lists of autocompleted values:*/
                                        closeAllLists();
                                    });
                                    a.appendChild(b);
                                }
                            }
                        });
                        /*execute a function presses a key on the keyboard:*/
                        inp.addEventListener("keydown", function(e) {
                            var x = document.getElementById(this.id + "autocomplete-list");
                            if (x) x = x.getElementsByTagName("div");
                            if (e.keyCode == 40) {
                                /*If the arrow DOWN key is pressed,
                                increase the currentFocus variable:*/
                                currentFocus++;
                                /*and and make the current item more visible:*/
                                addActive(x);
                            } else if (e.keyCode == 38) { //up
                                /*If the arrow UP key is pressed,
                                decrease the currentFocus variable:*/
                                currentFocus--;
                                /*and and make the current item more visible:*/
                                addActive(x);
                            } else if (e.keyCode == 13) {
                                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                                e.preventDefault();
                                if (currentFocus > -1) {
                                    /*and simulate a click on the "active" item:*/
                                    if (x) x[currentFocus].click();
                                }
                            }
                        });

                        function addActive(x) {
                            /*a function to classify an item as "active":*/
                            if (!x) return false;
                            /*start by removing the "active" class on all items:*/
                            removeActive(x);
                            if (currentFocus >= x.length) currentFocus = 0;
                            if (currentFocus < 0) currentFocus = (x.length - 1);
                            /*add class "autocomplete-active":*/
                            x[currentFocus].classList.add("autocomplete-active text-justify");
                        }

                        function removeActive(x) {
                            /*a function to remove the "active" class from all autocomplete items:*/
                            for (var i = 0; i < x.length; i++) {
                                x[i].classList.remove("autocomplete-active");
                            }
                        }

                        function closeAllLists(elmnt) {
                            /*close all autocomplete lists in the document,
                            except the one passed as an argument:*/
                            var x = document.getElementsByClassName("autocomplete-items text-justify");
                            for (var i = 0; i < x.length; i++) {
                                if (elmnt != x[i] && elmnt != inp) {
                                    x[i].parentNode.removeChild(x[i]);
                                }
                            }
                        }
                        /*execute a function when someone clicks in the document:*/
                        document.addEventListener("click", function(e) {
                            closeAllLists(e.target);
                        });
                    }

                    /*An array containing all the country names in the world:*/
                    var items = [
                        @foreach ($autocomplete_product_and_service as $item)
                            "{{ $item->name }}",
                        @endforeach
                    ];

                    /*initiate the autocomplete function on the "search-input" element, and pass along the items array as possible autocomplete values:*/
                    autocomplete(document.getElementById("search-input"), items);
                </script>

                {{-- Search Component --}}
            </div>
        </div>
    </div>
    <!-- Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-theme">
        <!-- Container wrapper -->
        <div class="container justify-content-center justify-content-md-between">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('customer.beranda') }}">Beranda</a>
                    </li>

                    <!-- Navbar dropdown Product -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Katalog Produk
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($category_products as $item)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('customer.beranda') }}#{{ underscore($item->name) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Navbar dropdown Service -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownServices" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Katalog Jasa
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownServices">
                            @foreach ($category_services as $item)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('customer.beranda') }}#{{ underscore($item->name) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Navbar dropdown Lain-lain -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Lain-lain
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.store') }}">About</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Promo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Support</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Join with Us</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
