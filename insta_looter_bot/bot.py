import logging

from telegram import Bot, TelegramError, Update
from telegram.ext import CommandHandler, Filters, MessageHandler, Updater

from . import settings
from .commands import download, new_looter, request, start, unknown

logging.basicConfig(format='%(asctime)s - %(name)s - %(levelname)s - %(message)s', level=logging.INFO)
logger = logging.getLogger(__name__)


def error(bot: Bot, update: Update, error: TelegramError):
    """Log all errors from the telegram bot api

    Args:
        bot (:obj:`telegram.bot.Bot`): Telegram Api Bot Object.
        update (:obj:`telegram.update.Update`): Telegram Api Update Object
        error (:obj:`telegram.error.TelegramError`): Telegram Api TelegramError Object
    """
    logger.warning('Update "%s" caused error "%s"' % (update, error))


def main():
    updater = Updater(settings.TELEGRAM_API_TOKEN)
    dispatcher = updater.dispatcher

    dispatcher.add_handler(CommandHandler("start", start))
    dispatcher.add_handler(CommandHandler("help", start))
    dispatcher.add_handler(CommandHandler("request", request, pass_args=True))

    dispatcher.add_handler(MessageHandler(Filters.text, download))
    dispatcher.add_handler(MessageHandler(Filters.command, unknown))

    # log all errors
    dispatcher.add_error_handler(error)

    new_looter()

    updater.start_polling()
    logger.info('Started bot. Waiting for requests...')
    updater.idle()


if __name__ == '__main__':
    main()
