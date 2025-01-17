@extends('layout.layout')

@section('title','게시판')
@section('cssLink')
<link rel="stylesheet" href="/css/myCommon.css">
@endsection
@section('jsLink')
<script src="/js/board.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('main')    
<div class="text-center mt-5 mb-5">
    <h1>{{$boardInfo->bc_name}}</h1>
    {{-- <a href="{{route('boards.create')}}"> --}}
        {{-- create로 하여 create보드로 이동할 수 있으며 작성이 가능해진다 --}}
        <svg onclick="redirectInsert({{$boardInfo->bc_type}});" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
            class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
        </svg>
    </a>
</div>
<main>
    {{-- boardcontroller의 data 루프돌리기 --}}
    @foreach ($data as $item)
    <div id="card{{$item->b_id}}" class="card" style="width: 300px;">
        <img src="{{$item->b_img}}" class="card-img-top object-fit-cover" style="height: 300px;"
            alt="1">
        <div class="card-body">
            <h5 class="card-title">{{$item->b_title}}</h5>
            <p class="card-text">{{$item->b_content}}</p>
            {{-- 버튼클릭 시 해당 디테일로 이동하도록 수정 board.js --}}
            <button value="{{$item->b_id}}" type="button" class="btn btn-primary my-btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal">
                눌러보세요
            </button>
        </div>
    </div>
        
    @endforeach
    
</main>

 <!-- Modal -->
 <div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalTitle"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <p id="modalCreatedAt">시간</p>
                <p id="modalContent">살려줘요</p>
                <br>
                <img id="modalImg" src="../bootstrap/img/집좋아.gif" style="width: 200px; height: 200px;" class="card-img-top"
                    alt="">
                <br>
            </div>
            <div class="modal-footer justify-content-between">
                <div id="modalDeleteParent">
                    {{-- <button id="modalDelete" type="button" class="btn btn-warnig">삭제</button> --}}
                </div>
                <div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
