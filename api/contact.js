
const nodemailer = require('nodemailer');

module.exports = async (req, res) => {
    if (req.method !== 'POST') {
        return res.status(405).json({ errors: [{ message: 'Method Not Allowed' }] });
    }

    const { name, email, phone, message } = req.body;

    if (!name || !email || !message) {
        return res.status(400).json({ errors: [{ message: 'Merci de remplir tous les champs obligatoires.' }] });
    }

    // Configuration du transporteur SMTP (Gmail)
    const transporter = nodemailer.createTransport({
        service: 'gmail',
        auth: {
            user: 'espoir.canin.67@gmail.com',
            pass: 'Ytpy segm mxsz cddk' // App Password
        }
    });

    try {
        await transporter.sendMail({
            from: '"Site Espoir Canin" <espoir.canin.67@gmail.com>',
            to: 'espoir.canin@outlook.fr',
            replyTo: email,
            subject: `🐶 Nouveau contact de ${name} - Espoir Canin`,
            text: `Nom: ${name}\nEmail: ${email}\nTéléphone: ${phone}\n\nMessage:\n${message}`,
            html: `
            <div style='font-family: sans-serif; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
                <h2 style='color: #59d600;'>Nouveau message depuis le site web</h2>
                <p><strong>Nom :</strong> ${name}</p>
                <p><strong>Email :</strong> <a href='mailto:${email}'>${email}</a></p>
                <p><strong>Téléphone :</strong> ${phone}</p>
                <hr>
                <p><strong>Message :</strong></p>
                <p style='background: #f9f9f9; padding: 15px; border-left: 4px solid #59d600;'>${message.replace(/\n/g, '<br>')}</p>
            </div>
            `
        });

        res.status(200).json({ success: true, message: '✅ Message envoyé avec succès !' });
    } catch (error) {
        console.error('Erreur envoi email:', error);
        res.status(500).json({ errors: [{ message: "❌ Oups ! Une erreur s'est produite lors de l'envoi." }] });
    }
};
