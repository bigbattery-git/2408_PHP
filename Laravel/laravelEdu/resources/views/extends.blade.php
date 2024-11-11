{{-- @extends('layout.layout')

@section('key', '타이틀임')

@section('main')
		<h1>
			이 메시지는 extends.blade.php에서 보냅니다. ㅎㅎ
		</h1>
@endsection

@section('show')
		<h6>이젠 아니야...</h6>
@endsection

<hr>

{{-- @if : 조건문 --}}
{{-- @if ($data[0]['gender'] === 'F')
	<span>여자</span>
@elseif($data[0]['gender']==='M')
	<span>남자</span>
@else
	<span>다양성 존중</span>
@endif --}}

{{-- 반복문 --}}



{{-- @for($i = 0; $i <5 ; $i++)
	<br>
	<span>{{ $i }}</span>
@endfor --}}

{{-- @foreach ($data as $item)
	<div style="{{ $loop->odd ? 'color: red' : 'color: blue' }}">	
		<span>{{ $item['name'] }}</span>
		<span>{{ $item['gender'] }}</span>
	</div>
@endforeach --}}

@forelse ($data2 as $item)
	<div style="{{ $loop->odd ? 'color: red' : 'color: blue' }}">	
		<span>{{ $item['name'] }}</span>
		<span>{{ $item['gender'] }}</span>
	</div>
@empty
	<div>데이터 없당</div>
@endforelse