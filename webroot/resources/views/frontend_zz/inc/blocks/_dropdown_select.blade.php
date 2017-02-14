<?php
$preselectedItemKey = (isset($selectedItemKey) && array_key_exists($selectedItemKey,$selectItems))? $selectedItemKey : key($selectItems);
$dropDownCssClass = (isset($dropDownCssClass) && !empty($dropDownCssClass))? $dropDownCssClass : '';

$HTMLAttributesNotToBeChanged = ['data-name','class'];
$attributeOptionsHTML =
                    isset($attributeOptions)?

                    join(' ', array_map(function($key) use ($HTMLAttributesNotToBeChanged, $attributeOptions)
                    {
                       if(in_array($key,$HTMLAttributesNotToBeChanged)){
                            return '';
                       }
                       if(is_bool($attributeOptions[$key]))
                       {
                          return $attributeOptions[$key]?$key:'';
                       }
                       return $key.'="'.$attributeOptions[$key].'"';
                    }, array_keys($attributeOptions)))

                    : '';

?>
<div {!!$attributeOptionsHTML!!} data-name="{{$selectName}}" class="dropDownSelect dropdown gray-dropdown @if( isset($attributeOptions['class']) ) {{$attributeOptions['class']}} @endif">
    <input type="hidden" name="{{$selectName}}" value="{{$preselectedItemKey}}">
    <button class="btn btn-default dropdown-toggle" type="button" id="cover_my" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        @if(isset($selectItems[$preselectedItemKey])){{$selectItems[$preselectedItemKey]}}@endif
    </button>
    <ul class="dropdown-menu" aria-labelledby="cover_my">

    <?php
        $nrOfItemsInSelect = count($selectItems);
        $i=0;
    ?>
    @foreach($selectItems as $key => $text )
        <?php $i++;?>
        <li><a href="javascript:void(0);" data-value="{{$key}}">{{$text}}</a></li>
        @if($i < $nrOfItemsInSelect)
            <li role="separator" class="divider"></li>
        @endif
    @endforeach
    </ul>
</div>