<section id="contato" class="py-32">
    <div class="max-w-3xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center">Entre em contato</h2>

        <form method="POST" action="{{ route('contact.send') }}" class="mt-12 grid gap-6">
            @csrf

            <div>
                <label class="block text-sm text-gray-300">Nome</label>
                <input type="text" name="name" required
                       class="mt-2 w-full rounded-xl bg-zinc-900 border border-white/10 px-4 py-3">
            </div>

            <div>
                <label class="block text-sm text-gray-300">Email</label>
                <input type="email" name="email" required
                       class="mt-2 w-full rounded-xl bg-zinc-900 border border-white/10 px-4 py-3">
            </div>

            <div>
                <label class="block text-sm text-gray-300">Mensagem</label>
                <textarea name="message" rows="4" required
                          class="mt-2 w-full rounded-xl bg-zinc-900 border border-white/10 px-4 py-3"></textarea>
            </div>

            <button type="submit"
                    class="w-full rounded-xl bg-cyan-500 py-3 text-black font-medium hover:bg-cyan-400 transition">
                Enviar mensagem
            </button>

        </form>
    </div>
</section>
