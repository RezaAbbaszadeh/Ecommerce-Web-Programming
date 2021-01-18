@props(['subcategories' => $subcategories])

@foreach($subcategories as $subcategory)
 <ul>
    <li>{{$subcategory->name}}</li> 
  @if(count($subcategory->subcategory))
    <?php $x = $category->subcategory; ?>
    <x-category :subcategories="$x"/>
  @endif
 </ul> 
@endforeach