@extends('layouts.app-user')

@section('content')

<style>
    .collection-grid{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:30px;
}

/* CARD */

.library-card{
background:white;
border-radius:12px;
overflow:hidden;
border:1px solid #e5e7eb;
transition:all .25s ease;
position:relative;
}

.library-card:hover{
transform:translateY(-6px);
box-shadow:0 18px 35px rgba(0,0,0,0.12);
}

/* COVER */

.library-cover{
aspect-ratio: 2 / 3;
background:#f5f5f5;
overflow:hidden;
}

.library-cover img{
width:100%;
height:100%;
object-fit:cover;
transition:.4s;
}

.library-card:hover img{
transform:scale(1.05);
}

/* BODY */

.library-body{
padding:14px;
}

.library-title{
font-size:14px;
font-weight:600;
line-height:1.3;
margin-bottom:5px;
color:#111827;
}

.library-author{
font-size:12px;
color:#6b7280;
margin-bottom:10px;
}

/* BADGE */

.library-badge{
display:inline-block;
font-size:11px;
padding:3px 8px;
border-radius:20px;
background:#e0f2fe;
color:#0369a1;
margin-bottom:10px;
}

/* ACTION */

.library-action{
display:flex;
justify-content:space-between;
align-items:center;
}

.remove-btn{
font-size:12px;
border:none;
background:#ef4444;
color:white;
padding:6px 10px;
border-radius:6px;
cursor:pointer;
transition:.2s;
}

.remove-btn:hover{
background:#dc2626;
}

.details-btn{
font-size:12px;
text-decoration:none;
color:#2563eb;
}
    </style>

    <div class="collection-grid">

@foreach($books as $book)

<div class="library-card">

<div class="library-cover">
<img src="{{ asset('storage/'.$book->cover) }}">
</div>

<div class="library-body">

<div class="library-title">
{{ $book->title }}
</div>

<div class="library-author">
{{ $book->author }}
</div>

<div class="library-badge">
Koleksi Saya
</div>

<div class="library-action">

<a href="{{ route('books.show',$book->id) }}" class="details-btn">
Lihat Detail
</a>

<form action="#" method="POST">
@csrf
<button class="remove-btn">
Hapus
</button>
</form>

</div>

</div>

</div>

@endforeach

</div>
@endsection