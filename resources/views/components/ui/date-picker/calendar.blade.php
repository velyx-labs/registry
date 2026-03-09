<div x-show="open" x-cloak x-transition.opacity.duration.150ms
    class="bg-popover border-border absolute z-50 mt-2 w-72 rounded-xl border p-4 shadow-lg"
    data-slot="date-picker-calendar">
    <div class="mb-4 flex items-center justify-between">
        <button type="button" @click.stop="prevMonth()" class="hover:bg-accent rounded-lg p-1.5 transition-colors">
            <x-dynamic-component component="lucide-chevron-left" class="text-muted-foreground size-4" />
        </button>
        <span class="text-foreground text-sm font-semibold" x-text="monthNames[viewMonth] + ' ' + viewYear"></span>
        <button type="button" @click.stop="nextMonth()" class="hover:bg-accent rounded-lg p-1.5 transition-colors">
            <x-dynamic-component component="lucide-chevron-right" class="text-muted-foreground size-4" />
        </button>
    </div>

    <div class="mb-2 grid grid-cols-7">
        <template x-for="day in ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']">
            <div class="text-muted-foreground py-1 text-center text-xs font-medium" x-text="day"></div>
        </template>
    </div>

    <div class="grid grid-cols-7 gap-0.5">
        <template x-for="i in emptyDays">
            <div class="h-8"></div>
        </template>

        <template x-for="day in daysInMonth">
            <button type="button" @click.stop="selectDate(day)" x-text="day" :disabled="isDisabled(day)" :class="{
                    'bg-primary text-primary-foreground': isSelected(day),
                    'ring-1 ring-primary': isToday(day) && !isSelected(day),
                    'hover:bg-accent': !isSelected(day) && !isDisabled(day),
                    'opacity-30 cursor-not-allowed': isDisabled(day)
                }" class="h-8 w-full rounded-md text-sm transition-colors"></button>
        </template>
    </div>

    <div class="border-border mt-3 border-t pt-3">
        <button type="button" @click.stop="goToday()"
            class="text-primary hover:bg-accent w-full rounded-lg py-1.5 text-sm font-medium transition-colors">
            Today
        </button>
    </div>
</div>