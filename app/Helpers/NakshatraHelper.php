<?php

namespace App\Helpers;

/**
 * Readings for the 27 nakshatras (index 0 = Ashwini), their presiding deities
 * and the four padas, used by the Nakshatra and Ishta Devata reports.
 */
class NakshatraHelper
{
    // Per nakshatra: [professional life, marriage and compatibility, health]
    const READINGS = [
        ['Does well in medicine, healing, sports, transport, the armed forces and any work that needs speed and quick decisions. Success comes early and becomes steady after the age of 30.', 'Loving and protective of family, but impatient at home. Marriage is happiest with a partner who gives space and shares an active life.', 'The head is the sensitive area: headaches, fever and injuries caused by haste. Regular sleep and unhurried habits protect health.'],
        ['Suited to law, administration, finance, hospitality, the arts and any role that carries responsibility for others. Works best when given authority.', 'Passionate and loyal, with strong opinions at home. A patient partner who respects this independence makes the marriage lasting.', 'Generally strong. The reproductive system, the head and blood pressure need attention, and overwork should be avoided.'],
        ['Fits the army, police, engineering, surgery, cooking, teaching and leadership roles. Sharp judgement brings respect at work.', 'Devoted to family but blunt in speech. Home life is peaceful when anger is kept in check and praise is given freely.', 'Body heat runs high: acidity, fevers, eye and dental trouble are common. Cooling food and regular meals help.'],
        ['Shines in the arts, fashion, design, agriculture, food, banking and luxury trades. Steady effort brings growth, and the best years come after the mid-thirties.', 'Affectionate and family-loving, with a wish for comfort and attention. Marriage is happy when possessiveness is kept in balance.', 'The throat, neck and blood sugar are sensitive. A sweet tooth needs control, and colds should not be ignored.'],
        ['Good at research, writing, travel, sales, textiles, music and teaching. Curiosity leads to several changes of field before settling.', 'Gentle and romantic but slow to trust. Open conversation with the partner removes the doubts that trouble married life.', 'The shoulders, throat and digestion are weak points. Nervous restlessness is eased by routine and enough sleep.'],
        ['Does well in technology, science, research, medicine, analysis and work that solves hard problems. Progress comes after effort and upheaval.', 'Deeply feeling yet outwardly sharp. Marriage improves with age, as patience grows and words become softer.', 'The lungs, throat and nerves need care. Stress shows up as breathing or sleep trouble, so calm habits matter.'],
        ['Suited to teaching, writing, counselling, spiritual work, travel and trade. Does best in work that has meaning, more than work for money alone.', 'Kind, home-loving and forgiving. Family life is content, and an early setback in relationships is often followed by a happier second chance.', 'Usually healthy. The chest, liver and ears need attention, and weight should be watched in later years.'],
        ['Fits government service, teaching, banking, dairy and food, social work and advisory roles. Reliable effort brings a secure, respected position.', 'Caring, dutiful and protective of family. Marriage is stable, and it grows warmer when feelings are spoken and not only shown through duty.', 'The stomach, chest and lungs are sensitive. Simple home food and regular hours keep the body strong.'],
        ['Good at psychology, medicine, pharmacy, law, politics, research and occult studies. A sharp reading of people brings success in strategy.', 'Intense and private in love. Trust comes slowly, and the marriage thrives when suspicion is replaced by openness.', 'Digestion, nerves and joints need care. Worry affects the stomach quickly, so relaxation is important.'],
        ['Suited to administration, politics, management, history, law and family business. Natural authority leads to positions of command.', 'Proud, generous and protective of family honour. Marriage is happy when ego is set aside and the partner is treated as an equal.', 'The heart, back and blood pressure are the weak points. Regular exercise and rest protect health.'],
        ['Shines in entertainment, music, the arts, fashion, hospitality, events and public relations. Creative talent brings income and recognition.', 'Romantic, affectionate and fond of family life. Marriage is joyful when comfort-loving habits are balanced with responsibility.', 'Generally good. The heart, spine and skin need care, and overindulgence in food and comfort should be avoided.'],
        ['Does well in administration, social service, teaching, human resources, counselling and steady professions. Dependability earns promotion.', 'Loyal and helpful, and takes marriage seriously. A happy home is built on keeping promises and sharing responsibility.', 'The stomach, intestines and nerves are sensitive. Regular meals and less overwork keep health steady.'],
        ['Fits crafts, design, healing, accounting, trade, writing and any skilled work of the hands. Resourcefulness brings gains.', 'Caring and attentive, with a wish for order at home. Marriage runs smoothly when criticism is softened with humour.', 'Digestion and the nervous system need care. Worry is the main cause of illness, so calm routines help.'],
        ['Suited to architecture, design, engineering, fashion, jewellery, photography and the arts. An eye for detail makes the work stand out.', 'Attractive and passionate, with strong likes and dislikes. Marriage is happiest when temper is controlled and the partner is given room.', 'The kidneys, lower abdomen and forehead are sensitive. Enough water and moderation keep the body in balance.'],
        ['Does well in business, trade, law, diplomacy, travel and independent professions. Works best when free to decide.', 'Fair, gentle and independent. Marriage is steady when both partners respect each other\'s freedom.', 'The kidneys, skin and digestion need attention. Gas and joint stiffness are eased by light food and movement.'],
        ['Fits management, politics, law, research, sales and public speaking. Determination brings success in the later part of life.', 'Devoted to spouse and family, but ambition can take time away from home. Sharing goals with the partner keeps the bond strong.', 'The lower abdomen, kidneys and hormones are sensitive. Regular exercise and control over diet are important.'],
        ['Good at organising, diplomacy, foreign trade, science, counselling and team leadership. Success often comes away from the place of birth.', 'Loyal, loving and devoted. Married life is warm when feelings are expressed and jealousy is kept aside.', 'The stomach, bowels and reproductive system need care. Regular hours and less emotional strain help.'],
        ['Suited to administration, police and defence, management, investigation and senior roles. Responsibility comes early and builds capability.', 'Protective and caring, but used to having the last word. Marriage is peaceful when authority is shared.', 'The muscles, shoulders and reproductive system are sensitive. Tension should be released through exercise and rest.'],
        ['Does well in research, medicine, philosophy, law, investigation and spiritual teaching. Likes work that goes to the root of a problem.', 'Independent and frank. Marriage settles well after the early years, once freedom and commitment find a balance.', 'The hips, thighs and nerves need care. Sciatica and restlessness are eased by stretching and regular sleep.'],
        ['Fits law, public speaking, teaching, shipping and travel, the arts and motivational work. Persuasion is the main strength.', 'Affectionate and proud. Marriage is happy with a partner who respects this self-belief and is respected in return.', 'The thighs, hips and kidneys are sensitive. Enough water and care with rich food keep health good.'],
        ['Suited to government, law, defence, engineering, social work and leadership. Slow, honest effort brings lasting success after the mid-thirties.', 'Responsible and sincere. Marriage is stable, and it warms when time is kept for the partner despite duty.', 'The knees, skin and stomach need care. Regular checks and a simple routine prevent trouble.'],
        ['Good at teaching, media, counselling, languages, music, travel and information work. Listening and learning bring respect.', 'Gentle and family-minded. Marriage is content, with a partner who shares traditional values.', 'The ears, knees and skin are sensitive. Digestion needs care, and damp or cold should be avoided.'],
        ['Fits music, sports, engineering, real estate, the armed forces and management. Energy and rhythm bring wealth.', 'Generous and lively, though firm in opinion. Marriage needs patience and may come a little late, but it is solid.', 'The back, ankles and blood pressure need attention. Regular movement and less stress help.'],
        ['Does well in medicine, healing, technology, research, astrology and independent work. Prefers to work alone and in its own way.', 'Private and truthful. Marriage improves when feelings are shared instead of being kept inside.', 'The calves, ankles and circulation are sensitive. A fixed routine protects against sudden illness.'],
        ['Suited to research, finance, teaching, occult studies, social causes and business. Strong ideals shape the career.', 'Passionate and devoted, with firm views. Marriage is happy when flexibility is added to principle.', 'The ankles, feet and liver need care. Moderation in food and enough rest are important.'],
        ['Fits counselling, charity, teaching, research, yoga and spiritual work, and steady service roles. Patience brings respect.', 'Calm, kind and dependable. Married life is peaceful and deepens with time.', 'The feet and digestion are sensitive. Cold and lethargy are eased by warmth and activity.'],
        ['Good at the arts, music, travel, shipping, healing, charity and work with children or animals. Creativity and kindness guide the career.', 'Loving, gentle and devoted to family. Marriage is happy with a practical partner who offers security.', 'The feet and stomach need care. Sensitivity to stress is eased by rest and a quiet routine.'],
    ];

    // Presiding deity of each nakshatra: [name in the North, name in the South, who the deity is]
    const DEVATA = [
        ['Ashwini Kumar', 'Asvini Devargal', 'The twin physicians of the gods and riders of the dawn, worshipped for healing, speed and protection on every journey.'],
        ['Yama', 'Emadharmar', 'The lord of dharma and keeper of the law of karma, worshipped for discipline, truth and freedom from fear.'],
        ['Agni', 'Agni Bhagavan', 'The sacred fire that carries offerings to the gods, worshipped for purity, energy and the burning away of obstacles.'],
        ['Brahma', 'Brahma Devan', 'The creator and the source of knowledge and of all beginnings, worshipped for learning, creativity and children.'],
        ['Soma', 'Chandran', 'The Moon god and lord of the divine nectar, worshipped for peace of mind, beauty and nourishment.'],
        ['Rudra', 'Rudran', 'The fierce form of Lord Shiva who destroys sorrow, worshipped for courage, healing and transformation.'],
        ['Aditi', 'Aditi Devi', 'The mother of the gods and of boundless space, worshipped for protection, abundance and a fresh start.'],
        ['Brihaspati', 'Guru Bhagavan', 'The teacher of the gods, worshipped for wisdom, good counsel and prosperity.'],
        ['Naga', 'Naga Devargal', 'The serpent deities who guard hidden treasure and wisdom, worshipped for protection and inner power.'],
        ['Pitrs', 'Pithrukkal', 'The ancestors of the family line, honoured for blessings, continuity and a good name.'],
        ['Bhaga', 'Bhagha Devan', 'The god who gives good fortune and happiness in marriage, worshipped for prosperity and delight.'],
        ['Aryaman', 'Aryaman Devan', 'The god of friendship, hospitality and contracts, worshipped for lasting bonds and honour.'],
        ['Savitar', 'Savita Devan', 'The rising Sun who awakens the world, worshipped with the Gayatri mantra for skill and clear thought.'],
        ['Tvashtar', 'Vishwakarma', 'The divine architect, worshipped for craftsmanship, creativity and success in everything that is built.'],
        ['Vayu', 'Vayu Bhagavan', 'The god of wind and breath, worshipped for strength, freedom and good health.'],
        ['Indra-Agni', 'Indiran-Agni', 'Power and fire together, worshipped for victory, determination and the reaching of goals.'],
        ['Mitra', 'Mithran', 'The god of friendship and agreements, worshipped for harmony, loyalty and cooperation.'],
        ['Indra', 'Indiran', 'The king of the gods, worshipped for courage, authority and protection.'],
        ['Nirriti', 'Nirriti Devi', 'The goddess of dissolution, propitiated to remove misfortune and to clear the ground for a new start.'],
        ['Apah', 'Neer Devargal', 'The deities of the sacred waters, worshipped for purification, renewal and invincibility.'],
        ['Vishvadeva', 'Vishwadevar', 'The ten universal gods, worshipped for virtue, lasting victory and good conduct.'],
        ['Vishnu', 'Thirumal', 'The preserver of the universe, worshipped for protection, knowledge and steady progress.'],
        ['Vasu', 'Vasu Devargal', 'The eight gods of the elements and of wealth, worshipped for abundance, music and fame.'],
        ['Varuna', 'Varuna Devan', 'The lord of the cosmic waters and of moral law, worshipped for healing and forgiveness.'],
        ['Aja Ekapada', 'Ajaikapada', 'The one-footed unborn one, a form of Rudra, worshipped for spiritual fire and the strength to do penance.'],
        ['Ahirbudhnya', 'Ahirbudhnya', 'The serpent of the deep, worshipped for wisdom, restraint and inner depth.'],
        ['Pushan', 'Pooshan Devan', 'The nourisher and guardian of travellers, worshipped for safe journeys, prosperity and guidance.'],
    ];

    // Nature a pada takes from the Navamsa sign it falls in (index 0 = Aries)
    const PADA_TRAITS = [
        'energetic, independent and quick to act',
        'steady, practical and fond of comfort and wealth',
        'curious, talkative and quick to learn',
        'caring, emotional and attached to home',
        'proud, confident and drawn to leadership',
        'analytical, careful and service-minded',
        'sociable, fair and fond of beauty',
        'intense, secretive and determined',
        'principled, optimistic and fond of learning',
        'ambitious, disciplined and hard-working',
        'original, humane and independent in thought',
        'gentle, imaginative and spiritual',
    ];

    /**
     * The four padas of a nakshatra, each with its Navamsa sign, that sign's lord and its nature.
     */
    public static function padas(int $nakIndex): array
    {
        $padas = [];
        for ($pada = 1; $pada <= 4; $pada++) {
            $sign = ($nakIndex * 4 + $pada - 1) % 12;
            $padas[$pada] = [
                'navamsa' => TransitHelper::SIGNS[$sign],
                'lord'    => AscendantHelper::LORDS[$sign],
                'text'    => 'This pada falls in ' . TransitHelper::SIGNS[$sign] . ' Navamsa, ruled by ' . AscendantHelper::LORDS[$sign] . '. People born in it are ' . self::PADA_TRAITS[$sign] . '.',
            ];
        }

        return $padas;
    }
}
