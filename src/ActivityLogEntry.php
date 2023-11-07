<?php

namespace Marvinosswald\FilamentActivityLog;

use Filament\Infolists\Components\Entry;
use Rogervila\ArrayDiffMultidimensional;

class ActivityLogEntry extends Entry
{
    protected string $view = 'filament-activity-log::activity-log-entry';

    protected array $with = [];

    protected ?\Closure $formatSubjectUsing = null;

    protected ?\Closure $formatCauserUsing = null;

    public static function make(string $name = 'activities'): static
    {
        $static = app(static::class, ['name' => $name]);
        $static->configure();

        return $static;
    }
    protected function setUp() : void
    {
        $this->getStateUsing(function ($record) {
            $activities[] = $record->{$this->getStatePath()};
            foreach ($this->with as $relationship) {
                if (str_contains($relationship, ".")){
                    $relationship = explode(".", $relationship);
                    $activities[] = $record->{$relationship[0]}->{$relationship[1]};
                }
                else {
                    $activities[] = $record->{$relationship};
                }
            }
            return collect($activities)->flatten()->filter();
        });
    }




    public function with(string | array $relationships): static
    {
        if (is_array($relationships)) {
            $this->with = array_merge($this->with, $relationships);
        } else {
            $this->with[] = $relationships;
        }

        return $this;
    }

    public function formatSubjectUsing(\Closure $closure): static
    {
        $this->formatSubjectUsing = $closure;

        return $this;
    }

    public function formatCauserUsing(\Closure $closure): static
    {
        $this->formatCauserUsing = $closure;

        return $this;
    }

    public function getSubject($activity){
        if ($this->formatSubjectUsing !== null) {
            return $this->evaluate($this->formatSubjectUsing, [
                'activity' => $activity,
            ]);
        }
        return $activity->subject_type;
    }

    public function getCauser ($activity){
        if ($this->formatCauserUsing !== null) {
            return $this->evaluate($this->formatCauserUsing, [
                'activity' => $activity,
            ]);
        }
        return $activity->causer?->getFullname() ?? "System";
    }

    public function getDiff($activity)
    {
        return collect(ArrayDiffMultidimensional::looseComparison($activity->properties["attributes"], $activity->properties["old"]))
        ->map(fn($value, $key) => (object) [
                'from' => $activity->properties["old"][$key],
                'to' => $value,
            ]);

    }
}
