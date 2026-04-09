
@extends('layouts.app-user')

@section('content')

<style>
.page-header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:35px;
padding:35px;
border-radius:28px;
background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
color:white;
position:relative;
overflow:hidden;
}

.page-header::before{
content:'';
position:absolute;
width:260px;
height:260px;
background:rgba(255,255,255,0.08);
border-radius:50%;
top:-80px;
right:-60px;
}

.page-header::after{
content:'';
position:absolute;
width:180px;
height:180px;
background:rgba(255,255,255,0.05);
border-radius:50%;
bottom:-60px;
left:-40px;
}

.page-header-content{
position:relative;
z-index:2;
}

.page-header h1{
font-size:34px;
font-weight:800;
margin-bottom:10px;
}

.page-header p{
font-size:15px;
color:rgba(255,255,255,0.85);
max-width:650px;
line-height:1.7;
}

.collection-count{
position:relative;
z-index:2;
background:rgba(255,255,255,0.12);
backdrop-filter:blur(12px);
padding:18px 24px;
border-radius:20px;
text-align:center;
border:1px solid rgba(255,255,255,0.15);
min-width:140px;
}

.collection-count h2{
font-size:28px;
font-weight:800;
margin:0;
}

.collection-count span{
font-size:13px;
color:rgba(255,255,255,0.8);
}

.collection-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
gap:28px;
}

.library-card{
background:white;
border-radius:24px;
overflow:hidden;
border:1px solid #e5e7eb;
transition:all .3s ease;
position:relative;
box-shadow:0 10px 30px rgba(15,23,42,0.06);
}

.library-card:hover{
transform:translateY(-8px);
box-shadow:0 25px 45px rgba(15,23,42,0.12);
}

.library-cover{
position:relative;
aspect-ratio:2 / 3;
background:#f3f4f6;
overflow:hidden;
}

.library-cover img{
width:100%;
height:100%;
object-fit:cover;
transition:transform .45s ease;
}

.library-card:hover .library-cover img{
transform:scale(1.08);
}

.library-overlay{
position:absolute;
inset:0;
background:linear-gradient(to top,rgba(0,0,0,0.55),transparent 60%);
opacity:0;
transition:.3s;
}

.library-card:hover .library-overlay{
opacity:1;
}

.library-body{
padding:18px;
}

.library-title{
font-size:16px;
font-weight:700;
line-height:1.5;
margin-bottom:6px;
color:#111827;
min-height:48px;
}

.library-author{
font-size:13px;
color:#6b7280;
margin-bottom:14px;
}

.library-badge{
display:inline-flex;
align-items:center;
gap:6px;
font-size:11px;
font-weight:600;
padding:6px 12px;
border-radius:999px;
background:#dbeafe;
color:#1d4ed8;
margin-bottom:18px;
}

.library-action{
display:flex;
gap:10px;
}

.details-btn,
.remove-btn{
flex:1;
text-align:center;
padding:10px 12px;
border-radius:12px;
font-size:13px;
font-weight:600;
transition:.25s;
}

.details-btn{
text-decoration:none;
background:#eff6ff;
color:#2563eb;
border:1px solid #bfdbfe;
}

.details-btn:hover{
background:#2563eb;
color:white;
}

.remove-btn{
border:none;
background:#fee2e2;
color:#dc2626;
cursor:pointer;
}

.remove-btn:hover{
background:#dc2626;
color:white;
}

.empty-state{
text-align:center;
padding:80px 20px;
background:white;
border-radius:28px;
border:1px dashed #d1d5db;
color:#6b7280;
}

.empty-state i{
font-size:48px;
margin-bottom:20px;
color:#9ca3af;
}

@media(max-width:768px){
.page-header{
flex-direction:column;
align-items:flex-start;
gap:20px;
padding:25px;
}

.page-header h1{
font-size:28px;
}
}
</style>

<div class="page-header">
    <div class="page-header-content">
        <h1>Koleksi Buku Saya</h1>
    </div>

    <div class="collection-count">
        <h2>{{ count($books) }}</h2>
        <span>Total Buku</span>
    </div>
</div>

@if(count($books) > 0)
<div class="collection-grid">

    @foreach($books as $book)

    <div class="library-card">

        <div class="library-cover">
            <img src="{{ asset('storage/'.$book->cover) }}" alt="{{ $book->title }}">
            <div class="library-overlay"></div>
        </div>

        <div class="library-body">

            <div class="library-title">
                {{ $book->title }}
            </div>

            <div class="library-author">
                {{ $book->author }}
            </div>
            
            <div class="library-action">

                <a href="{{ route('books.show',$book->id) }}" class="details-btn">
                    Lihat Detail
                </a>

                <form action="#" method="POST" style="flex:1;">
                    @csrf
                    <button class="remove-btn" type="submit">
                        Hapus
                    </button>
                </form>

            </div>

        </div>

    </div>

    @endforeach

</div>
@else
<div class="empty-state">
    <i class="fa fa-book"></i>
    <h2 class="text-2xl font-bold mb-2">Belum Ada Koleksi Buku</h2>
    <p>Kamu belum menambahkan buku ke koleksi pribadi.</p>
</div>
@endif
@endsection