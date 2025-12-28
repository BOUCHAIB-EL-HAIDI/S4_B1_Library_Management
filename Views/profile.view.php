<div class="max-w-6xl mx-auto">

<h1 class="text-3xl font-bold mb-8">👤 Mon Profil</h1>

<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="bg-white shadow-md rounded-lg p-6 mb-8">
    <h2 class="text-2xl font-bold mb-4">Informations Personnelles</h2>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <p class="text-gray-600">Prénom</p>
            <p class="font-bold text-lg"><?= htmlspecialchars($userInfo['firstName']) ?></p>
        </div>
        <div>
            <p class="text-gray-600">Nom</p>
            <p class="font-bold text-lg"><?= htmlspecialchars($userInfo['lastName']) ?></p>
        </div>
        <div>
            <p class="text-gray-600">Email</p>
            <p class="font-bold text-lg"><?= htmlspecialchars($userInfo['email']) ?></p>
        </div>
        <div>
            <p class="text-gray-600">Rôle</p>
            <p class="font-bold text-lg capitalize"><?= htmlspecialchars($userInfo['role']) ?></p>
        </div>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">📚 Mes Emprunts</h2>
    
    <?php if (empty($borrows)): ?>
        <div class="text-center py-8">
            <div class="text-5xl mb-4">📖</div>
            <p class="text-gray-600">Vous n'avez aucun emprunt pour le moment</p>
            <a href="/books" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Parcourir les livres
            </a>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-3 px-4 text-left">Titre du livre</th>
                        <th class="py-3 px-4 text-left">Date d'emprunt</th>
                        <th class="py-3 px-4 text-left">Date de retour</th>
                        <th class="py-3 px-4 text-left">Statut</th>
                        <th class="py-3 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($borrows as $borrow): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4 font-bold"><?= htmlspecialchars($borrow['title']) ?></td>
                        <td class="py-3 px-4"><?= date('d/m/Y', strtotime($borrow['borrowDate'])) ?></td>
                        <td class="py-3 px-4">
                            <?= $borrow['returnDate'] ? date('d/m/Y', strtotime($borrow['returnDate'])) : '-' ?>
                        </td>
                        <td class="py-3 px-4">
                            <?php if ($borrow['returnDate']): ?>
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                    ✓ Retourné
                                </span>
                            <?php else: ?>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    📖 En cours
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4">
                            <?php if (!$borrow['returnDate']): ?>
                                <form method="POST" action="/return" class="inline">
                                    <input type="hidden" name="borrowId" value="<?= $borrow['id'] ?>">
                                    <button 
                                        type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                                    >
                                        Retourner
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-gray-400">-</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-bold text-blue-900">Emprunts actifs</p>
                    <p class="text-sm text-blue-700">
                        <?= count(array_filter($borrows, fn($b) => !$b['returnDate'])) ?> livre(s) en cours
                    </p>
                </div>
                <div>
                    <p class="font-bold text-blue-900">Total emprunts</p>
                    <p class="text-sm text-blue-700"><?= count($borrows) ?> livre(s)</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

</div>