<div class="d-flex">
    <a href="{{ route('ruang_kerja', ['dashboard_id' => 1]) }}" class="btn rounded-10 me-2 @if($navId == 1) bg-primary @endif">Dashboard 1</a>
    <a href="{{ route('ruang_kerja', ['dashboard_id' => 2]) }}" class="btn rounded-10 me-2 @if($navId == 2) bg-primary @endif">Dashboard 2</a>
</div>