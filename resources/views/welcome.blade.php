<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Scanner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <div class="container col-lg-4 py-5">
        {{-- Title --}}
            <div class="col-md-12 text-center mb-3">
                <h2>KASIR QR RPL</h2>
            </div>
        {{-- Title --}}
        {{-- Scanner --}}
        <div class="card bg-white shadow rounded-3 p-3 border-0">
            {{-- Alert --}}
            @if (session()->has('failed'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('failed') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- Audio --}}
                  <audio id="myAudio" autoplay>
                    <source src="{{ asset('sounds/failed.mp3') }}" type="audio/mp3">
                  </audio>
                  <button hidden="hidden" onclick="myFunction()">Try it</button>
                  <p id="demo"></p>
                {{-- Audio --}}
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- Audio --}}
                  <audio id="myAudio" autoplay>
                    <source src="{{ asset('sounds/bazzar_rpl.mp3') }}" type="audio/mp3">
                  </audio>
                  <button hidden="hidden" onclick="myFunction()">Try it</button>
                  <p id="demo"></p>
                {{-- Audio --}}
            @endif

            @if (session()->has('notNull'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('notNull') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                {{-- Audio --}}
                  <audio id="myAudio" autoplay>
                    <source src="{{ asset('sounds/notnull.mp3') }}" type="audio/mp3">
                  </audio>
                  <button hidden="hidden" onclick="myFunction()">Try it</button>
                  <p id="demo"></p>
                {{-- Audio --}}
            @endif

            @if (session()->has('reset'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('reset') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            {{-- Alert --}}
            <video id="preview"></video>
        </div>
        {{-- Scanner --}}

        {{-- Form --}}
        <form action="{{ route('order.store') }}" method="post" id="form">
            @csrf
            <input type="hidden" name="id_item" id="id_item">
            <div class="d-flex col-md-12 text-center mt-4">
                <input type="text" name="quantity" class="form-control" placeholder="Masukan jumlah pesanan">
            </div>
        </form>
        {{-- Form --}}
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Jumlah Item</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
                @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->item->item_name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->item->price) }}</td>
                    <td>{{ number_format($order->total_price) }}</td>
                    {{-- <td>{{ number_format($order->item->price * $order->quantity) }}</td> --}}
                </tr>
                @endforeach
            </table>
            <div class="col-md-12 text-center mt-3">
                <a href="{{ route('order.reset') }}" class="btn btn-danger">Reset Pesanan</a>
                <a href="{{ route('order.print') }}" class="btn btn-primary">Cetak Pesanan</a> 
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan', function(c){
        document.getElementById('id_item').value = c;
        document.getElementById('form').submit();
      })

      function myFunction() {
        var x = document.getElementById("myAudio").autoplay;
        document.getElementById("demo").innerHTML = x;
      }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>