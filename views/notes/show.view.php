<?php

require base_path('views\partials\head.php') ?>
<?php
require base_path('views\partials\nav.php') ?>
<?php
require base_path('views\partials\banner.php') ?>


    <main>


        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8  ">
            <p class="mb-6">
                <a href="/notes" class="text-blue-500 hover:underline"> go back... </a>
            </p>
            
            <p class="mb-6"><?= htmlspecialchars($note['body']) ?></p>

            <footer class="mt-6">
                <a href="/note/edit?id=<?= $note['id'] ?>"
                   class="inline-flex justify-center inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>
            </footer>

            <form class="mt-6" method="post">
                <input type="hidden" name='_method' value="DELETE">
                <input type="hidden" name='id' value="<?= $note['id'] ?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>

        </div>
    </main>


<?php
require base_path('views\partials/footer.php') ?>