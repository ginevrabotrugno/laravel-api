<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height: 100%">
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href=" {{ route('admin.index') }} " class="nav-link text-white">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href=" {{ route('admin.projects.index') }} " class="nav-link text-white">
                <i class="fa-solid fa-list"></i>
                <span>Projects</span>
            </a>
        </li>
        <li>
            <a href=" {{ route('admin.projects.create') }} " class="nav-link text-white">
                <i class="fa-solid fa-square-plus"></i>
                <span>New</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.technologies.index') }}" class="nav-link text-white">
                <i class="fa-solid fa-gear"></i>
                <span>Technologies</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.types.index') }}" class="nav-link text-white">
                <i class="fa-solid fa-bars-progress"></i>
                <span>Types</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.typeProjects') }}" class="nav-link text-white">
                <i class="fa-solid fa-tag"></i>
                <span>Type Projects</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.projects.trash') }}" class="nav-link text-white">
                <i class="fa-solid fa-trash-can"></i>
                <span>Trash</span>
            </a>
        </li>
    </ul>
</div>
