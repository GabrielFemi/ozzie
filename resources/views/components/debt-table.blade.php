<div class="flex items-center justify-between">
    <p class="mb-6 text-black-lighter">Projects in descending order of "debt" (how much attention it needs)</p>

    @if ($hacktoberfest)
        <a href="https://github.com/search?o=desc&q=label%3Ahacktoberfest+is%3Aopen+type%3Aissue+user%3Atighten&s=created&type=Issues"
           target="_blank" rel="noopener noreferrer"
           class="mb-6 px-4 py-3 bg-grey-blue hover:bg-halloween-orange no-underline rounded-lg text-black-lighter hover:text-white hover-pop">
            Hacktoberfest is here! 👻
        </a>
    @endif
</div>

<div class="overflow-x-auto max-w-full">
<table class="table-auto rounded-lg shadow w-full">
    <thead class="bg-grey-blue-light border-grey border-b-2 text-left">
        <tr>
            <th class="text-grey-darkest font-bold uppercase text-xs leading-none tracking-wide p-4">Project Name</th>

            <th class="text-grey-darkest font-bold uppercase text-xs leading-none tracking-wide p-4">Debt Score</th>

            <th class="text-grey-darkest font-bold text-xs leading-none tracking-wide p-4">OLD PRs</th>

            <th class="text-grey-darkest font-bold uppercase text-xs leading-none tracking-wide p-4">Old Issues</th>

            <th class="text-grey-darkest font-bold text-xs leading-none tracking-wide p-4">PRs</th>

            <th class="text-grey-darkest font-bold uppercase text-xs leading-none tracking-wide p-4">Issues</th>

            @if ($hacktoberfest)
                <th class="text-xs p-4">🎃</th>
            @endif
        </tr>
    </thead>

    <tbody class="bg-white rounded-b-lg divide-y divide-smoke">
        @foreach ($projects->sortByDesc(function ($project) { return $project->debtScore(); }) as $project)
            <tr class="">
                <td class="p-4">
                    <a class="text-indigo no-underline text-md p-2 -mx-2"
                       href="#{{ $project->namespace }}-{{ $project->name }}">
                        {{ $project->namespace }}/{{ $project->name }}
                    </a>
                </td>

                <td class="text-black-lightest p-4">{{ number_format($project->debtScore(), 2) }}</td>

                <td class="text-black-lightest p-4">{{ $project->oldPrs()->count() }}</td>

                <td class="text-black-lightest p-4">{{ $project->oldIssues()->count() }}</td>

                <td class="text-black-lightest p-4">{{ $project->prs()->count() }}</td>

                <td class="text-black-lightest p-4">{{ $project->issues()->count() }}</td>

                @if ($hacktoberfest)
                    <td class="p-4">
                        <a class="text-indigo no-underline p-2 -mx-2"
                           href="https://github.com/{{ $project->namespace }}/{{ $project->name }}/labels/hacktoberfest"
                           target="_blank" rel="noopener noreferrer">
                            {{ $project->hacktoberfestIssues()->count() }}
                        </a>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
</div>
