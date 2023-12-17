@props(['task' => $task])

@php
    $completedPercent = round($task->countCompletedDescendants() / $task->countChildrenRecursive() * 100);
@endphp

<div class="after:w-[{{ $completedPercent }}%] mt-[12px] project-completion-bar min-w-[100px] max-w-[220px]">
    <span class="bg-primary rounded-3xl px-2 z-20 relative text-white">{{ $completedPercent }}%</span>
</div>

@section("preloadClasses")


<div class="after:w-[0%]"></div>
<div class="after:w-[1%]"></div>
<div class="after:w-[2%]"></div>
<div class="after:w-[3%]"></div>
<div class="after:w-[4%]"></div>
<div class="after:w-[5%]"></div>
<div class="after:w-[6%]"></div>
<div class="after:w-[7%]"></div>
<div class="after:w-[8%]"></div>
<div class="after:w-[9%]"></div>

<div class="after:w-[10%]"></div>
<div class="after:w-[11%]"></div>
<div class="after:w-[12%]"></div>
<div class="after:w-[13%]"></div>
<div class="after:w-[14%]"></div>
<div class="after:w-[15%]"></div>
<div class="after:w-[16%]"></div>
<div class="after:w-[17%]"></div>
<div class="after:w-[18%]"></div>
<div class="after:w-[19%]"></div>

<div class="after:w-[20%]"></div>
<div class="after:w-[21%]"></div>
<div class="after:w-[22%]"></div>
<div class="after:w-[23%]"></div>
<div class="after:w-[24%]"></div>
<div class="after:w-[25%]"></div>
<div class="after:w-[26%]"></div>
<div class="after:w-[27%]"></div>
<div class="after:w-[28%]"></div>
<div class="after:w-[29%]"></div>

<div class="after:w-[30%]"></div>
<div class="after:w-[31%]"></div>
<div class="after:w-[32%]"></div>
<div class="after:w-[33%]"></div>
<div class="after:w-[34%]"></div>
<div class="after:w-[35%]"></div>
<div class="after:w-[36%]"></div>
<div class="after:w-[37%]"></div>
<div class="after:w-[38%]"></div>
<div class="after:w-[39%]"></div>

<div class="after:w-[40%]"></div>
<div class="after:w-[41%]"></div>
<div class="after:w-[42%]"></div>
<div class="after:w-[43%]"></div>
<div class="after:w-[44%]"></div>
<div class="after:w-[45%]"></div>
<div class="after:w-[46%]"></div>
<div class="after:w-[47%]"></div>
<div class="after:w-[48%]"></div>
<div class="after:w-[49%]"></div>

<div class="after:w-[50%]"></div>
<div class="after:w-[51%]"></div>
<div class="after:w-[52%]"></div>
<div class="after:w-[53%]"></div>
<div class="after:w-[54%]"></div>
<div class="after:w-[55%]"></div>
<div class="after:w-[56%]"></div>
<div class="after:w-[57%]"></div>
<div class="after:w-[58%]"></div>
<div class="after:w-[59%]"></div>

<div class="after:w-[60%]"></div>
<div class="after:w-[61%]"></div>
<div class="after:w-[62%]"></div>
<div class="after:w-[63%]"></div>
<div class="after:w-[64%]"></div>
<div class="after:w-[65%]"></div>
<div class="after:w-[66%]"></div>
<div class="after:w-[67%]"></div>
<div class="after:w-[68%]"></div>
<div class="after:w-[69%]"></div>

<div class="after:w-[70%]"></div>
<div class="after:w-[71%]"></div>
<div class="after:w-[72%]"></div>
<div class="after:w-[73%]"></div>
<div class="after:w-[74%]"></div>
<div class="after:w-[75%]"></div>
<div class="after:w-[76%]"></div>
<div class="after:w-[77%]"></div>
<div class="after:w-[78%]"></div>
<div class="after:w-[79%]"></div>

<div class="after:w-[80%]"></div>
<div class="after:w-[81%]"></div>
<div class="after:w-[82%]"></div>
<div class="after:w-[83%]"></div>
<div class="after:w-[84%]"></div>
<div class="after:w-[85%]"></div>
<div class="after:w-[86%]"></div>
<div class="after:w-[87%]"></div>
<div class="after:w-[88%]"></div>
<div class="after:w-[89%]"></div>

<div class="after:w-[90%]"></div>
<div class="after:w-[91%]"></div>
<div class="after:w-[92%]"></div>
<div class="after:w-[93%]"></div>
<div class="after:w-[94%]"></div>
<div class="after:w-[95%]"></div>
<div class="after:w-[96%]"></div>
<div class="after:w-[97%]"></div>
<div class="after:w-[98%]"></div>
<div class="after:w-[99%]"></div>

<div class="after:w-[100%]"></div>
@endsection
