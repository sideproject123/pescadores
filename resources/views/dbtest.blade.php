<!doctype>
<html>
<body>
@foreach ($users as $u)
  <span>{{ $u->nickname }}</span>
@endforeach
</body>
</html>