<x-app-layout>
    <x-slot name="header_content">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a><i class="fas fa-stream"></i> {{ __('Daftar Iklan') }}</a></li>
        </ol>
    </x-slot>

    <div class="row py-12 mt-12">
        <div class="col-12">
            <div class="card">

                @if(Session::has('success'))
                    <div class="alert text-center alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif

                <div class="card-header justify-content-between">

                    <div class="btn-group" style="display: none" id="action" >
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="deleteSelectedItem" href="#">Hapus Iklan yang dipilih</a>
                        </div>
                    </div>

                    <form class="form-inline">
                        <div class="input-group">
                            <label style="margin-bottom: 0; margin-top: 2px; margin-left: 5px;">
                                <input type="text" class="form-control" placeholder="Cari iklan anda">
                            </label>
                            <div style="margin-top: 2px;" class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="add-product-btn">
                        <a href="{{route('products.create')}}" class="btn btn-icon icon-left btn-primary ">
                            <i class="fas fa-cart-plus"></i> Tambah Produk</a>
                    </div>


                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="mytable table-striped p-0">
                            <thead>
                            <tr style="height: 60px; background: #ffffff; color: #858585;">
                                <th colspan="1" class="pl-4">
                                    <label>
                                        <input
                                            name="checkedAll"
                                            id="checkedAll"
                                            type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        &nbsp;Pilih iklan untuk melakukan aksi
                                    </label>
                                </th>
                                <th class="text-center">Kondisi</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Stok</th>
                                <th class="text-center">ID Iklan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($listproducts->count())
                                @foreach($listproducts as $listproduct)
                                    {{--<tr class="row-product" id="pid{{$listproduct->id}} product-hover">
                                        <td style="width: 30%" class="td p-0 pl-4 text-center">
                                            <div class="float-left custom-control-child">
                                                <label>
                                                    <input name="ids"
                                                           id="checkSingle"
                                                           type="checkbox"
                                                           class="checkSingle rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                           value="{{ $listproduct -> id }}">
                                                </label>
                                            </div>
                                            <a class="text-decoration-none text-black" href="{{ url( 'detail/'.Str::slug($listproduct->users->name).'/'.$listproduct -> id.'/'.Str::slug($listproduct->nama) ) }}">
                                                <div style="margin: 13px auto 0 30px;">
                                                    <p class="text-judul-product mb-1 leading-5 text-justify">{{ $listproduct->nama }}</p>
                                                </div>
                                                    <img style="display: block; margin-left: auto; margin-right: auto;" class="img c-thumb" alt="image"
                                                         data-toggle="tooltip" title=""  src="{{ asset("storage/product-image")."/".$listproduct ->images->image_path }}">
                                            </a>--}}
                                    <tr id="pid{{$listproduct->id}}">
                                        <td style="width: 30%"  class="td p-0 pl-4 text-center">
                                            <div class="flex-column-product custom-control-child">
                                                <label class="float-left">
                                                    <input name="ids"
                                                           id="checkSingle"
                                                           type="checkbox"
                                                           class="checkSingle rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                           value="{{ $listproduct -> id }}">
                                                </label>
                                                <a class="text-decoration-none text-black" href="{{ url( 'detail/'.Str::slug($listproduct->users->name).'/'.$listproduct -> id.'/'.Str::slug($listproduct->name) ) }}">
                                                    <div style="margin: 2px 0 0 30px;">
                                                        <p class="text-judul-product mb-1 leading-5 text-justify">{{ $listproduct->name }}</p>
                                                    </div>
                                                    <img style="display: block; margin-left: auto; margin-right: auto;" class="img c-thumb" alt="image"
                                                         data-toggle="tooltip" title=""  src="{{ asset("storage/product-image")."/".$listproduct -> images -> image_path }}">
                                                </a>
                                            </div>
                                            <div>
                                                <p class="mx-auto my-2">
                                                    👀 &nbsp;&nbsp;100&nbsp;&nbsp;
                                                    😍 &nbsp;&nbsp;15&nbsp;&nbsp;
                                                    📨 &nbsp;&nbsp;8
                                                </p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-success">Bekas</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-success">{{ $listproduct-> categories -> name }}</div>
                                        </td>
                                        <td class="text-center">
                                            @currency($listproduct->price)
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-success">100</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-success">{{ "#".number_format($listproduct->id) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                            <a href="#" class="btn btn-danger delete"
                                               data-toggle="modal"
                                               data-target="#deleteModal"
                                               data-productid="{{$listproduct->id}}"><i class="fas fa-times"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center text-white py-32 bg-red-400">Anda belum mempunyai iklan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-left" style="vertical-align: center;">
                        Menampilkan
                        {{ $listproducts->firstItem() }}
                        -
                        {{ $listproducts->lastItem() }}
                        data dari
                        {{ $listproducts->total() }}
                        total iklan.
                    </div>
                    <div class=float-right>
                        {{ $listproducts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Delete Warning Modal -->
<div class="modal fade show" tabindex="-1" role="dialog" id="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin ?</h5>
            </div>
            <form action="#" method="post" id="delete_product_form">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <h5>Kamu ingin menghapus iklan ini ?</h5>
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-undo"></i> Batal</button>
                    <button type="submit" class="btn btn-icon icon-left btn-danger"><i class="fas fa-times"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Delete Modal -->

<script>
    $(document).ready(function() {
        $("#checkedAll").change(function() {
            if (this.checked) {
                $(".checkSingle").each(function() {
                    this.checked=true;
                });
            } else {
                $(".checkSingle").each(function() {
                    this.checked=false;
                });
            }
        });

        $(".checkSingle").click(function () {
            if ($(this).is(":checked")) {
                let isAllChecked = 0;

                $(".checkSingle").each(function() {
                    if (!this.checked)
                        isAllChecked = 1;
                });

                if (isAllChecked === 0) {
                    $("#checkedAll").prop("checked", true);
                }
            }
            else {
                $("#checkedAll").prop("checked", false);
            }
        });

        $("#deleteSelectedItem").click(function (e){
            e.preventDefault();
            let allids = [];

            $("input:checkbox[name=ids]:checked").each(function (){
                allids.push($(this).val());
            })

            $.ajax({
                url:"{{route('products.deleteSelectedProduct')}}",
                type:"DELETE",
                data:{
                    _token:$("input[name=_token]").val(),
                    ids:allids
                },
                success:function (response){
                    $.each(allids, function (key,val){
                        $("#pid"+val).remove();
                    })
                }
            });
        });

        $(document).on('click','.delete',function(){
            let id = $(this).data('productid');
            $('#delete_product_form').attr('action', '/products/' + id);
        });

        $('table').on('change', ':checkbox', function() {
            $('#action').toggle(!!$('input:checkbox:checked').length);
        });

    });

</script>

